<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\ShipCity;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Notifications\OrderComplete;
use Carbon\Carbon;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification as Notification;
use Illuminate\Support\Facades\Redirect;

class StripeController extends Controller
{
    
    // ------------------> FOR STRIPE PAYMENT <----------------------
    public function StripeOrder(Request $request){
        $user = User::where('role', 'admin')->get();
        if(Session::has('coupoun')){
            $total_amount = Session::get('coupoun')['total_amount'];
            $discount_amount = Session::get('coupoun')['discount_amount'];
        }
        else{
            $total_amount = round(Cart::total());
            $discount_amount = 0;
        }

        \Stripe\Stripe::setApiKey('sk_test_51OfF36AIv39y6cmEZjb9WSgs07eVCEsd8VqVyrMBqcFguRCaQ8cQ3r7W8wQ6Czf4oyW8G98mF97jjuXWHjIuHQZN00AqNgV01u');

        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $total_amount*100,
            'currency' => 'npr',
            'description' => 'Alostab Vendors',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);        
        // dd($charge);

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'district_id' => $request->district_id,
            'city_id' => $request->city_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => $charge->payment_method,
            'payment_method' => 'Stripe',
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'discount_amount' => $discount_amount,

            'order_number' => $charge->metadata->order_id,
            'invoice_number' => 'ALOV'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            
            'status' => 'pending',
            'created_at' => Carbon::now(),
            
        ]);

        // START -> SEND MAIL
        $invoice = Order::findOrFail($order_id);
        $data =[
            'invoice_no' =>$invoice->invoice_number,
            'amount' =>$total_amount,
            'discount_amount' => $discount_amount,
            'name' =>$invoice->name,
            'email' =>$invoice->email,
            'address' =>$invoice->address,
            'order_date' => $invoice->order_date,
        ];

        Mail::to($request->email)->send(new OrderMail($data));

        // END -> SEND MAIL


        $carts = Cart::content();
        foreach($carts as $cart){
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vendor_id' => $cart->options->vendor,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }
        // end for each
        if(Session::has('coupoun')){
            Session::forget('coupoun');
        }
        Cart::destroy();

        $notification = array(
            'message' => "Your Order Has Been Placed Successfully.",
            'alert-type' => 'success'
        );

        Notification::send($user, new OrderComplete($request->name));
        
        return redirect()->route('dashboard')->with($notification);
    }
    // END FUNCTION



    // ------------------> FOR CASH ON DELIVERY <----------------------

    public function CashOrder(Request $request)
    {
        $user = User::where('role','admin')->get();

        $this->OrderSuccess($request);

        $notification = array(
            'message' => "Your Order Has Been Placed Successfully.",
            'alert-type' => 'success'
        );
        

        Notification::send($user, new OrderComplete($request->name));

        return redirect()->route('dashboard')->with($notification);
    }
    // END FUNCTION   


    // --------------> OrderSucess <-------------------------
    public function OrderSuccess($request) {
        // dd($request->input());   
        if (Session::has('coupoun')) {
            $total_amount = Session::get('coupoun')['total_amount'];
            $discount_amount = Session::get('coupoun')['discount_amount'];
        } else {
            $total_amount = round(Cart::total());
            $discount_amount = 0;
        }

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'district_id' => $request->district_id,
            'city_id' => $request->city_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => $request->payment_type ?? 'Cash On Delivery',
            'payment_method' => $request->payment_method ?? 'Cash On Delivery',
            'currency' => 'Rs.',
            'amount' => $total_amount,
            'discount_amount' => $discount_amount,

            'invoice_number' => 'ALOV' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),

            'status' => 'pending',
            'created_at' => Carbon::now(),

        ]);

        // START -> SEND MAIL
        try {
            $invoice = Order::findOrFail($order_id);
            $data = [
                'invoice_no' => $invoice->invoice_number,
                'amount' => $total_amount,
                'discount_amount' => $discount_amount,
                'name' => $invoice->name,
                'email' => $invoice->email,
                'address' => $invoice->address,
                'order_date' => $invoice->order_date,
            ];

            Mail::to($request->email)->send(new OrderMail($data));
        } catch (Exception $e) {
        }
        // END -> SEND MAIL


        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vendor_id' => $cart->options->vendor,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }
        // end for each
        if (Session::has('coupoun')) {
            Session::forget('coupoun');
        }
        Cart::destroy();
    } 



    // For Khalti Payment 

    public function KhaltiVerification(Request $request)
    {
        // Retrieve dynamic amount from session
        if (Session::has('coupoun')) {
            $total_amount = Session::get('coupoun')['total_amount'];
            $discount_amount = Session::get('coupoun')['discount_amount'];
        } else {
            $total_amount = round(Cart::total());
            $discount_amount = 0;
        }

        $total_amount_paisa = (int) ($total_amount * 100);

        
        $url = "https://a.khalti.com/api/v2/epayment/initiate/";
        session(['khaltiPayment' => $request->input()]);
        $requestBackURL = str_replace(" ", "","http://127.0.0.1:8000/khalti/callback");
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "return_url": "'. $requestBackURL . '",
            "website_url": "http://127.0.0.1:8000",
            "amount": "10000",
            "purchase_order_id": "Order01",
            "purchase_order_name": "test",
            "customer_info": {
                "name": "Alostab Vendors",
                "email": "alostabvendors@gmail.com",
                "phone": "9800000001"
            }
        }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: key 189c72dd39804d72aaba91de589b2882',
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response_data = json_decode($response, true);

        if ($response_data && isset($response_data['payment_url'])) {
            return Redirect::to($response_data['payment_url']);
        } else {
            return "Error initiating payment.";
        }
    }

    public function KhaltiCallback(Request $request) {
        // dd($request->input('status'));
        $user = User::where('role', 'admin')->get();
        if($request->input('status') == 'Completed'){

            $request->merge(session('khaltiPayment'));
            $request->merge(["payment_method"=>"Khalti"]);
            $request->merge(["payment_type" => "Khalti Online"]);
            $this->OrderSuccess($request);
            
            $notification = array(
                'message' => "Your Order Has Been Placed Successfully.",
                'alert-type' => 'success'
            );

           
            Session::forget('khaltiPayment');
            Notification::send($user, new OrderComplete($request->name));
     
            return redirect()->route('dashboard')->with($notification);
        }
    }

}
