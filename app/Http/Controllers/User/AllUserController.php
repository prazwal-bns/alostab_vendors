<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AllUserController extends Controller
{
    public function UserAccount(){
        $id = Auth::user()->id; // gives authentic user id --> logged in user
        $userData = User::find($id); // User data obtained from id
        return view('frontend.userDashboard.account_details',compact('userData'));
    }
    // END FUNCTION

    public function UserChangePassword(){
        return view('frontend.userDashboard.user_change_password');
    }
    // END FUNCITON

    public function UserOrderPage(){
        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)->orderBy('id', 'DESC')->paginate(8); // Paginate with 10 orders per page
        return view('frontend.userDashboard.user_order_page',compact('orders'));
    }
    // END FUNCITON

    public function UserOrderDetails($order_id){
        $order = Order::with('District','City','State','User')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('Product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        return view('frontend.order.order_details',compact('order', 'orderItem'));
    }
    // END FUNCITON

    public function UserInvoiceDownload($order_id){
        $order = Order::with('District','City','State','User')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('Product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('frontend.order.order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }
    // END FUNCITON
}