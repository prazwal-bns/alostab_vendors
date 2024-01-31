<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coupoun;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CoupounController extends Controller
{
    public function AllCoupoun()
    {
        $coupoun = Coupoun::latest()->get();
        return view('backend.coupoun.all_coupoun', compact('coupoun'));
    }
    // end function

    public function AddCoupoun()
    {
        return view('backend.coupoun.add_coupoun');
    }
    // end function

    public function StoreCoupoun(Request $request){
        Coupoun::insert([
            'coupoun_name' => strtoupper($request->coupoun_name),
            'coupoun_discount' => $request->coupoun_discount,
            'coupoun_validity' => $request->coupoun_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Coupoun Inserted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupoun')->with($notification);
    }
    // End function

    public function EditCoupoun($id)
    {
        $coupoun = Coupoun::findOrFail($id);
        return view('backend.coupoun.edit_coupoun', compact('coupoun'));
    }
    //end function


    public function UpdateCoupoun(Request $request, $id)
    {
        $coupoun_id = $id;
        Coupoun::findOrFail($coupoun_id)->update([
            'coupoun_name' => strtoupper($request->coupoun_name),
            'coupoun_discount' => $request->coupoun_discount,
            'coupoun_validity' => $request->coupoun_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Coupon Updated Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupoun')->with($notification);
    }
    // end function

    public function DeleteCoupoun($id)
    {
        Coupoun::findOrFail($id)->delete();

        $notification = array(
            'message' => "Coupoun Deleted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    //end function

}
