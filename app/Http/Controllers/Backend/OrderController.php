<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function PendingOrder(){
        $orders = Order::where('status','pending')->orderBy('id','DESC')->get();
        return view('backend.orders.pending_orders',compact('orders'));
    }
    // END FUNCTION

    public function AdminConfirmOrder(){
        $orders = Order::where('status','confirm')->orderBy('id','DESC')->get();
        return view('backend.orders.confirmed_orders',compact('orders'));
    }
    // END FUNCTION

    public function AdminProcessingOrder(){
        $orders = Order::where('status','processing')->orderBy('id','DESC')->get();
        return view('backend.orders.processing_orders',compact('orders'));
    }
    // END FUNCTION

    public function AdminDeliveredOrder(){
        $orders = Order::where('status','delivered')->orderBy('id','DESC')->get();
        return view('backend.orders.delivered_orders',compact('orders'));
    }
    // END FUNCTION

    public function AdminOrderDetails($order_id){
        $order = Order::with('District', 'City', 'State', 'User')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('Product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('backend.orders.admin_order_details', compact('order', 'orderItem'));
    }
    // END FUNCTION

    // CHANGE ORDER STATUS -> Pending, confirm, processing & delivered
    public function PendingToConfirm($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'confirm',
        ]);
        $notification = array(
            'message' => "Order Confirmed Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('admin.confirmed.order')->with($notification);
    }
    // END FUNCTION

    public function ConfirmToProcessing($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'processing',
        ]);
        $notification = array(
            'message' => "Order Processed Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('admin.processing.order')->with($notification);
    }
    // END FUNCTION

    public function ProcessingToDelivered($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'delivered',
        ]);
        $notification = array(
            'message' => "Order Delivered Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('admin.delivered.order')->with($notification);
    }
    // END FUNCTION

    public function AdminInvoiceDownload($order_id)
    {
        $order = Order::with('District', 'City', 'State', 'User')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('Product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        $pdf = Pdf::loadView('frontend.order.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }
    // END FUNCITON
}
