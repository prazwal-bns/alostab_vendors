<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ActiveUserController extends Controller
{
    public function AllUser(){
        $users = User::where('role','user')->latest()->get();
        return view('backend.user.all_user_data',compact('users'));
    }
    // ENd func

    public function AllVendor(){
        $vendors = User::where('role','vendor')->latest()->get();
        return view('backend.user.all_vendor_data',compact('vendors'));
    }
    // ENd func
}
