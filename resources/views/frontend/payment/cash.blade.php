@extends('frontend.master_dashboard')
@section('main')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Cash On Delivery
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-6">
                    <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Your Order</h4>
                        <h6 class="text-muted">Your Order Details</h6>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">
                        <table class="table no-border">
                            <tbody>
                                @if(Session::has('coupoun'))
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Subtotal</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">Rs. {{ $cartTotal }}</h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Coupoun Name</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h6 class="text-danger text-end">{{ session()->get('coupoun')['coupoun_name']}} ({{ session()->get('coupoun')['coupoun_discount'] }}%) </h6>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Coupon Discount</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">Rs. {{ session()->get('coupoun')['discount_amount'] }}</h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Grand Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">Rs. {{ session()->get('coupoun')['total_amount'] }}</h4>
                                    </td>
                                </tr>
                                @else 
                                    <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Grand Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">Rs. {{ $cartTotal}}</h4>
                                    </td>
                                </tr>
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- END COL LG 6 --}}
            <div class="col-lg-6">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Make Cash Payment</h4>
                    </div>
                    <h5>You can pay your cash to our courier when you receive your product at your doorstep.</h5>
                    <div class="table-responsive order_table checkout">
                        <form action=" {{ route('cash.order') }} " method="post">
                            @csrf
                        <div class="form-row">
                             <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                             <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                             <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                             <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                             
                             <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                             <input type="hidden" name="city_id" value="{{ $data['city_id'] }}">
                             <input type="hidden" name="state_id" value="{{ $data['state_id'] }}">
                             <input type="hidden" name="address" value="{{ $data['shipping_address'] }}">
                             <input type="hidden" name="notes" value="{{ $data['notes'] }}">

                        </div>
                        <br>
                        <button class="btn btn-primary">Submit Payment</button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

@endsection
