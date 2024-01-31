<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDistricts;
use App\Models\ShipDivision;
use App\Models\ShipState;

class ShippingController extends Controller
{
    public function AllDivision(){
        $division = ShipDivision::latest()->get();
        return view('backend.ship.division.all_division', compact('division'));
    }
    // END FUNCTION
    public function AddDivision(){
        return view('backend.ship.division.add_division');
    }
    // END FUNCTION

    public function StoreDivision(Request $request)
    {
        ShipDivision::insert([
            'division_name' => $request->division_name,
        ]);

        $notification = array(
            'message' => "Division Inserted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification);
    }
    // End function

    public function EditDivision($id){
        $division = ShipDivision::findOrFail($id);
        return view('backend.ship.division.edit_division', compact('division'));
    }
    // End function

    public function UpdateDivision(Request $request, $id){
        $division_id = $id;
        ShipDivision::findOrFail($division_id)->update([
            'division_name' => $request->division_name,
        ]);

        $notification = array(
            'message' => "Division Updated Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification);
    }
    // End function

    public function DeleteDivision($id)
    {
        ShipDivision::findOrFail($id)->delete();

        $notification = array(
            'message' => "Division Deleted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    //end function


    // ------------------------------> FOR DISTRICT <-------------
    public function AllDistrict()
    {
        $district = ShipDistricts::latest()->get();
        return view('backend.ship.district.all_district', compact('district'));
    }
    // END FUNCTION

    public function AddDistrict()
    {
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        return view('backend.ship.district.add_district', compact('division'));
    }
    // END FUNCTION

    public function StoreDistrict(Request $request){
        ShipDistricts::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);

        $notification = array(
            'message' => "District Inserted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.district')->with($notification);
    }
    // END FUNCTION

    public function EditDistrict($id)
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistricts::findOrFail($id);
        return view('backend.ship.district.edit_district', compact('district','division'));
    }
    // End function

    public function UpdateDistrict(Request $request, $id)
    {
        $district_id = $id;
        ShipDistricts::findOrFail($district_id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);

        $notification = array(
            'message' => "District Updated Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.district')->with($notification);
    }
    // End function


    public function DeleteDistrict($id)
    {
        ShipDistricts::findOrFail($id)->delete();

        $notification = array(
            'message' => "District Deleted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    //end function



    // ------------------------------> FOR STATE <------------------------
    public function AllState()
    {
        $state = ShipState::latest()->get();
        return view('backend.ship.state.all_state', compact('state'));
    }
    // END FUNCTION

    public function AddState()
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistricts::orderBy('district_name', 'ASC')->get();
        return view('backend.ship.state.add_state', compact('division','district'));
    }
    // END FUNCTION

    public function StoreState(Request $request)
    {
        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);

        $notification = array(
            'message' => "State Inserted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification);
    }
    // END FUNCTION

    public function
    GetDistrict($division_id)
    {
        $dist = ShipDistricts::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($dist);
    }

    public function EditState($id)
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistricts::orderBy('district_name', 'ASC')->get();

        $state = ShipState::findOrFail($id);
        return view('backend.ship.state.edit_state', compact('district', 'division','state'));
    }
    // End function

    public function UpdateState(Request $request, $id)
    {
        $state_id = $id;
        ShipState::findOrFail($state_id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);

        $notification = array(
            'message' => "State Updated Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification);
    }
    // End function

    public function DeleteState($id)
    {
        ShipState::findOrFail($id)->delete();

        $notification = array(
            'message' => "State Deleted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    //end function
}
