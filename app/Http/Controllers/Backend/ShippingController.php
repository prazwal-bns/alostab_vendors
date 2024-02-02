<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipCity;
use App\Models\ShipDistrict;
use Illuminate\Http\Request;
use App\Models\ShipState;

class ShippingController extends Controller
{
    // ------------------------------> FOR DISTRICT <-------------
    public function AllDistrict(){
        $district = ShipDistrict::latest()->get();
        return view('backend.ship.district.all_district', compact('district'));
    }
    // END FUNCTION
    public function AddDistrict(){
        return view('backend.ship.district.add_district');
    }
    // END FUNCTION

    public function StoreDistrict(Request $request)
    {
        ShipDistrict::insert([
            'district_name' => $request->district_name,
        ]);

        $notification = array(
            'message' => "District Inserted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.district')->with($notification);
    }
    // End function

    public function EditDistrict($id){
        $district = ShipDistrict::findOrFail($id);
        return view('backend.ship.district.edit_district', compact('district'));
    }
    // End function

    public function UpdateDistrict(Request $request, $id){
        $district_id = $id;
        ShipDistrict::findOrFail($district_id)->update([
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
        ShipDistrict::findOrFail($id)->delete();

        $notification = array(
            'message' => "District Deleted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    //end function


    // ------------------------------> FOR CITY <-------------
    public function AllCity()
    {
        $city = ShipCity::latest()->get();
        return view('backend.ship.city.all_city', compact('city'));
    }
    // END FUNCTION

    public function AddCity()
    {
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        return view('backend.ship.city.add_city', compact('district'));
    }
    // END FUNCTION

    public function StoreCity(Request $request){
        ShipCity::insert([
            'district_id' => $request->district_id,
            'city_name' => $request->city_name,
        ]);

        $notification = array(
            'message' => "City Inserted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.city')->with($notification);
    }
    // END FUNCTION

    public function EditCity($id)
    {
        $district = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $city = ShipCity::findOrFail($id);
        return view('backend.ship.city.edit_city', compact('district', 'city'));
    }
    // End function

    public function UpdateCity(Request $request, $id)
    {
        $city_id = $id;
        ShipCity::findOrFail($city_id)->update([
            'district_id' => $request->district_id,
            'city_name' => $request->city_name,
        ]);

        $notification = array(
            'message' => "City Updated Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.city')->with($notification);
    }
    // End function


    public function DeleteCity($id)
    {
        ShipCity::findOrFail($id)->delete();

        $notification = array(
            'message' => "City Deleted Successfully",
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
        $district = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $city = ShipCity::orderBy('city_name', 'ASC')->get();
        return view('backend.ship.state.add_state', compact('district', 'city'));
    }
    // END FUNCTION

    public function StoreState(Request $request)
    {
        ShipState::insert([
            'district_id' => $request->district_id,
            'city_id' => $request->city_id,
            'state_name' => $request->state_name,
        ]);

        $notification = array(
            'message' => "State Inserted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification);
    }
    // END FUNCTION

    public function GetCity($district_id)
    {
        $city = ShipCity::where('district_id', $district_id)->orderBy('city_name', 'ASC')->get();
        return json_encode($city);
    }

    public function EditState($id)
    {
        $district = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $city = ShipCity::orderBy('city_name', 'ASC')->get();

        $state = ShipState::findOrFail($id);
        return view('backend.ship.state.edit_state', compact('district', 'city','state'));
    }
    // End function

    public function UpdateState(Request $request, $id)
    {
        $state_id = $id;
        ShipState::findOrFail($state_id)->update([
            'district_id' => $request->district_id,
            'city_id' => $request->city_id,
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
