<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Notifications\VendorRegNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification as Notification;

class VendorController extends Controller
{
    public function VendorDashboard(){
        $vendorId = Auth::id();

        $date = date('d F Y');

        $todaysOrder = Order::whereHas('orderItems', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        })->where('return_order', 0)->where('order_date', $date)->sum('amount');


        $totalRevenue = Order::whereHas('orderItems', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        })->where('return_order', 0)->sum('amount');


        $returnRequestedOrders = Order::whereHas('orderItems', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        })->where('return_order', 1)->get();


        $pendingOrders = Order::whereHas('orderItems', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        })->where('status', 'pending')->get();


        $vendorOrders = Order::whereHas('orderItems', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        })->where('status', 'pending')->orderBy('id', 'DESC')->limit(10)->get();


        return view('vendor.index', compact('todaysOrder', 'totalRevenue', 'returnRequestedOrders','pendingOrders', 'vendorOrders'));
    }
    // end func


    public function VendorLogin(){
        return view('vendor.vendor_login');
    }
    // end func

    public function VendorDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    }
    // end func
    public function VendorProfile()
    {
        $id = Auth::user()->id; // gives authentic user id --> logged in user
        $vendorData = User::find($id); // User data obtained from id
        return view('vendor.vendor_profile', compact('vendorData'));
    }
    // end func

    public function VendorProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->vendor_join = $request->vendor_join;
        $data->vendor_short_info = $request->vendor_short_info;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/vendor_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/vendor_images'), $filename);

            $data['photo'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Vendor Profile has been successfully updated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with(($notification));
    }
    // end func
    public function VendorChangePassword()
    {
        return view('vendor.vendor_change_password');
    }
    // end func
    public function VendorUpdatePassword(Request $request)
    {
        // Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
       
        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't Match!!");
        }



        // Update The new password 
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);
        return back()->with("status", "Password Changed Successfully");
    } 
    // End func 

    public function BecomeVendor(){
        return view ('auth.become_vendor');
    }
    // end func
    public function VendorRegister(Request $request)
    {
        $vUser = User::where('role', 'admin')->get();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'vendor_join' => $request->vendor_join,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Vendor has been successfully registered',
            'alert-type' => 'success'
        );

        Notification::send($vUser, new VendorRegNotification($request));

        return redirect()->route('vendor.login')->with(($notification));

    }
    // end func

    public function VendorMarkAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json(['message' => 'All notifications marked as read']);
    }
    // END FUNCTION



}
