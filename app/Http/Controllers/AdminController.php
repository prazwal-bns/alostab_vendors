<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VendorApproveNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Notification as Notification;


class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }
    // end func    
    public function AdminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
    // end func

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }
    // end func
    public function AdminProfile()
    {
        $id = Auth::user()->id; // gives authentic user id --> logged in user
        $adminData = User::find($id); // User data obtained from id
        return view('admin.admin_profile', compact('adminData'));
    }
    // end func

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);

            $data['photo'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile has been successfully updated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with(($notification));
    }
    // end func
    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    }
    // end func

    public function AdminUpdatePassword(Request $request)
    {
        // Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        // Check The Old Password
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

    public function InactiveVendor(){
        $inActiveVendor = User::where('status','inactive')->where('role','vendor')->latest()->get();
        return view('backend.vendor.inactive_vendor',compact('inActiveVendor')); 
    }
    // end function    
    
    public function ActiveVendor(){
        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        return view('backend.vendor.active_vendor',compact('activeVendor')); 
    }
    // end function

    public function InactiveVendorDetails($id){
        $inactiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details',compact('inactiveVendorDetails'));
    }
    // end function

    public function ActiveVendorApprove(Request $request){
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([
            'status' => 'active',
        ]);

        
        $notification = array(
            'message' => 'Vendor Activated Successfully',
            'alert-type' => 'success'
        );

        $vUser = User::where('role', 'vendor')->get();

        Notification::send($vUser, new VendorApproveNotification($request));
        
        return redirect()->route('active.vendor')->with($notification);
    }
    //end func

    public function ActiveVendorDetails($id){
        $activeVendorDetails = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details',compact('activeVendorDetails'));
    }
    // end function

    public function InactiveVendorApprove(Request $request){
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([
            'status' => 'inactive',
        ]);
        $notification = array(
            'message' => 'Vendor Deactivated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('inactive.vendor')->with($notification);
    }
    //end func

    // -----------> ALL ADMINS (Add and All admin user) METHOD <------------------
    public function AllAdmin(){
        $allAdminUser = User::where('role','admin')->latest()->get();
        return view('backend.admin.all_admin',compact('allAdminUser'));
    }
    // END FUNCTION

    public function AddAdmin(){
        $roles = Role::all();
        return view('backend.admin.add_admin',compact('roles'));
    }
    // ENd FUNCTION


    public function AdminUserStore(Request $request){
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        // if($request->roles){
        //     $user->assignRole($request->roles);
        // }

        // Manual / alternative approach -> 
        if ($request->roles) {
            // Convert string to array if it's not already an array
            $roles = is_array($request->roles) ? $request->roles : [$request->roles];

            // Iterate through each role and associate it with the user
            foreach ($roles as $roleId) {
                DB::table('model_has_roles')->insert([
                    'role_id' => $roleId,
                    'model_type' => 'App\Models\User',
                    'model_id' => $user->id,
                ]);
            }
        }

        $notification = array(
            'message' => 'New Admin User Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.admin')->with($notification);
    }
    // ENd FUNCTION

    public function EditAdminRole($id){
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('backend.admin.edit_admin', compact('user','roles')); 
    }
    // ENd FUNCTION

    public function AdminUserUpdate(Request $request, $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Update user attributes with data from the request
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        // Save the updated user record
        $user->save();



        // GIVES ERROR
        // if($request->roles){
        //     $user->assignRole($request->roles);
        // }


        // Alternative approach ->

        // Convert string to array if it's not already an array
        $roles = is_array($request->roles) ? $request->roles : explode(',', $request->roles);

        // Remove all existing roles associated with the user
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();

        // Add the new roles provided in the request
        foreach ($roles as $roleId) {
            DB::table('model_has_roles')->insert([
                'role_id' => $roleId,
                'model_type' => 'App\Models\User', 
                'model_id' => $user->id,
            ]);
        }

        // Redirect back with a success message
        $notification = [
            'message' => 'Admin User Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.admin')->with($notification);
    }

    // END FUNCTION

    public function DeleteAdminRole($id){
        $user = User::findOrFail($id);
        if(!is_null($user)){
            $user->delete();
        }
        $notification = [
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
    // END FUNCTION
}
