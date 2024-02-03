<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ShipCity;
use App\Models\ShipDistricts;
use App\Models\ShipState;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function GetCityAjax($district_id){
        $ship = ShipCity::where('district_id', $district_id)->orderBy('city_name','ASC')->get();
        return json_decode($ship);
    }
    // end function

    public function GetStateAjax($city_id){
        $ship = ShipState::where('city_id', $city_id)->orderBy('state_name','ASC')->get();
        return json_decode($ship);
    }
    // end function

    public function StoreCheckout(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;

        $data['district_id'] = $request->district_id;
        $data['city_id'] = $request->city_id;
        $data['state_id'] = $request->state_id;

        $data['post_code'] = $request->post_code;
        $data['shipping_address'] = $request->shipping_address;
        $data['notes'] = $request->notes;

        $cartTotal = Cart::total();

        if($request->payment_option == 'stripe'){
            return view('frontend.payment.stripe',compact('data','cartTotal'));
        }
        elseif($request->payment_option=='card'){
            return 'Card Page';
        }
        else{
            return view('frontend.payment.cash',compact('data','cartTotal'));
        }
    }
    // end function
    
}
