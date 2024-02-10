<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{
    public function VendorOrder()
    {
        $id = Auth::user()->id;
        $orderItems = OrderItem::with('Order')->where('vendor_id', $id)->orderBy('id', 'DESC')->get();
        return view('vendor.backend.orders.pending_orders', compact('orderItems'));
    }
    // END FUNCTION

    public function VendorReturnOrder(){
        $id = Auth::user()->id;
        $orderItems = OrderItem::with('Order')->where('vendor_id', $id)->orderBy('id', 'DESC')->get();
        return view('vendor.backend.orders.return_orders', compact('orderItems'));
    }
    // END FUNCTION

    public function VendorCompleteReturnOrder(){
        $id = Auth::user()->id;
        $orderItems = OrderItem::with('Order')->where('vendor_id', $id)->orderBy('id', 'DESC')->get();
        return view('vendor.backend.orders.completed_return_orders', compact('orderItems'));
    }
    // END FUNCTION


    public function VendorOrderDetails($order_id){
        $order = Order::with('District', 'City', 'State', 'User')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('Product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('vendor.backend.orders.vendor_order_details', compact('order', 'orderItem'));
    }
    // END FUNCTION
}
