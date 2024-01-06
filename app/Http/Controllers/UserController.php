<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserDashboard(){
        $id = Auth::user()->id; // gives authentic user id --> logged in user
        $userData = User::find($id); // User data obtained from id
        return view('index', compact('userData'));
    }
    // end func
    public function UserProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);

            $data['photo'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'User Profile has been successfully updated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with(($notification));
    }
    public function UserLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logged Out successfully',
            'alert-type' => 'info'
        );


        return redirect('/login')->with($notification);
    }
    // end func
    public function UserUpdatePassword (Request $request)
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
}
