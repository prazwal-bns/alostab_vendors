<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupoun;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\AbstractTranslator;
use Carbon\Carbon;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id){
        $product = Product::findOrFail($id);
        if($product->discount_price == NULL){
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ]
            ]);
            return response()->json(['success' => 'Product Successfully added to Your Cart']);
        }
        else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price - $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ]
            ]);
            return response()->json(['success' => 'Product Successfully added to Your Cart']);
        }
    }
    // end function

    public function AddMiniCart(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    }
    // end function

    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Successfully Removed From Cart.']);
    }
    // end function


    // ADD TO CART FROM PRODUCT DETAILS
    public function AddToCartDetails(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ]
            ]);
            return response()->json(['success' => 'Product Successfully added to Your Cart']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price - $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ]
            ]);
            return response()->json(['success' => 'Product Successfully added to Your Cart']);
        }
    }
    // end function

    public function MyCart(){
        return view('frontend.myCart.view_myCart');
    }
    // end function

    // Load CART
    public function GetCartProduct(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    }
    // end function

    // REMOVE MY CART
    public function RemoveMyCart($rowId){
        Cart::remove($rowId);
        if (Session::has('coupoun')) {
            $coupoun_name = Session::get('coupoun')['coupoun_name'];
            $coupoun = Coupoun::where('coupoun_name', $coupoun_name)->first();

            Session::put('coupoun', [
                'coupoun_name' => $coupoun->coupoun_name,
                'coupoun_discount' => $coupoun->coupoun_discount,
                'discount_amount' => round(Cart::total() * $coupoun->coupoun_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupoun->coupoun_discount / 100),
            ]);
        }
        return response()->json(['success' => 'Product Successfully Removed From Your Cart']);
    }
    // end function

    // QUANTITY DECREMENT
    public function CartDecrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId,$row->qty -1 );

        if (Session::has('coupoun')) {
            $coupoun_name = Session::get('coupoun')['coupoun_name'];
            $coupoun = Coupoun::where('coupoun_name', $coupoun_name)->first();

            Session::put('coupoun', [
                'coupoun_name' => $coupoun->coupoun_name,
                'coupoun_discount' => $coupoun->coupoun_discount,
                'discount_amount' => round(Cart::total() * $coupoun->coupoun_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupoun->coupoun_discount / 100),
            ]);
        }

        return response()->json('DECREMENT');
    }
    // end function

    // QUANTITY INCREMENT
    public function CartIncrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if(Session::has('coupoun')){
            $coupoun_name = Session::get('coupoun')['coupoun_name'];
            $coupoun = Coupoun::where('coupoun_name',$coupoun_name)->first();

            Session::put('coupoun', [
                'coupoun_name' => $coupoun->coupoun_name,
                'coupoun_discount' => $coupoun->coupoun_discount,
                'discount_amount' => round(Cart::total() * $coupoun->coupoun_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupoun->coupoun_discount / 100),
            ]);
        }

        return response()->json('INCREMENT');
    }
    // END FUNCTION


    // --------------------> APPLYIG COUPOUN <---------------
    public function ApplyCoupoun(Request $request){
        $coupoun = Coupoun::where('coupoun_name',$request->coupoun_name)->where('coupoun_validity', '>=', Carbon::now()->format('Y-m-d'))->first();
        if ($coupoun){
            Session::put('coupoun',[
                'coupoun_name' => $coupoun->coupoun_name,
                'coupoun_discount' => $coupoun->coupoun_discount,
                'discount_amount' => round(Cart::total() * $coupoun->coupoun_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupoun->coupoun_discount/100),
            ]);
            return response()->json(array(
                'validity' => true,
                'success' => 'Coupoun Applied Successfully'
            ));
        }
        else{
            return response()->json(
                ['error' => 'Coupon not found or is invalid']
            );
        }
    }
    // END FUNCTION

    // COUPOUN CALCULATION
    public function CalculateCoupoun(){
        if(Session::has('coupoun')){
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupoun_name' => session()->get('coupoun')['coupoun_name'],
                'coupoun_discount' => session()->get('coupoun')['coupoun_discount'],
                'discount_amount' => session()->get('coupoun')['discount_amount'],
                'total_amount' => session()->get('coupoun')['total_amount'],
            ));
        }
        else{
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }
    // END FUNCTION

    // REMOVE COUPOUN
    public function RemoveCoupoun(){
        Session::forget('coupoun');
        return response()->json(['success' => 'Coupoun Removed Successfully']);
    }
    // END FUNCTION
}
