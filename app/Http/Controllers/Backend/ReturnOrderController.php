<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReturnOrderController extends Controller
{
    public function ReturnRequest(){
        $orders = Order::where('return_order',1)->orderBy('id','DESC')->get();
        return view('backend.returnOrder.return_request',compact('orders'));
    }
    // END FUNCTION

    public function CompletedOrderRequest(){
        $orders = Order::where('return_order',2)->orderBy('id','DESC')->get();
        return view('backend.returnOrder.completed_return_request',compact('orders'));
    }
    // END FUNCTION

    public function ApproveReturnRequest($order_id){
        Order::where('id',$order_id)->update([
            'return_order' => 2,
        ]);
        $notification = array(
            'message' => "Successfully Approved Order Return",
            'alert-type' => 'success'
        );

        return redirect()->route('completed.request')->with($notification);
    }
    // END FUNCTION
}
