@extends('dashboard')
@section('user')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="row">
                        {{-- START MENU MD -3 --}}
                        @include('frontend.body.dashboard_sidebar_menu')
                        {{-- END MENU MD -3 --}}

                        {{-- START COL md - 9 --}}
                        <div class="col-md-9">
                            {{-- START ROW --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Shipping Details</h4>
                                            <hr>
                                            <div class="card-body">
                                                <table class="table" style="font-weight: 600;">
                                                    <tr>
                                                        <th>User Name:</th>
                                                        <th>{{ $order->name }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Phone No.:</th>
                                                        <th>{{ $order->phone }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Email:</th>
                                                        <th>{{ $order->email }}</th>
                                                    </tr>
                                                      <tr>
                                                        <th>Postal Code:</th>
                                                        <th>{{ $order->post_code }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Shipping City:</th>
                                                        <th>{{ $order['City']['city_name'] }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Shipping District:</th>
                                                        <th>{{ $order['District']['district_name'] }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Shipping State:</th>
                                                        <th>{{ $order['State']['state_name'] }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Order Date:</th>
                                                        <th>{{ $order->order_date }}</th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- END COL MD_6 --}}
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Order Details: <hr><u class="text-danger">Invoice No:<span class="text-danger"> {{ $order->invoice_number }}</span></u></h4>
                                            <div class="card-body">
                                                <table class="table" style="font-weight: 600;">
                                                    <tr>
                                                        <th>Name:</th>
                                                        <th>{{ $order->user->name }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Phone:</th>
                                                        <th>{{ $order->user->phone }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Payment Type:</th>
                                                        <th>{{ $order->payment_method }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Transaction ID:</th>
                                                        <th>{{ $order->transaction_id }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Invoice No:</th>
                                                        <th class="text-danger">{{ $order->invoice_number }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Order Amount:</th>
                                                        <th class="text-success"><strong> Rs. {{ $order->amount }} </strong></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Order Status:</th>
                                                        <th>
                                                            @if ($order->status == 'pending')
                                                                <span class="badge badge-pill bg-warning"> Pending </span>
                                                            @elseif ($order->status == 'confirm')
                                                                <span class="badge badge-pill bg-info"> Confirm </span>
                                                            @elseif ($order->status == 'processing')
                                                                <span class="badge badge-pill bg-danger"> Proccessing </span>
                                                            @elseif ($order->status == 'delivered')
                                                                <span class="badge badge-pill bg-success"> Delivered </span>
                                                            @endif
                                                        </th>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- END COL MD_6 --}}
                            </div>
                            {{-- END ROW --}}
                        </div>
                        {{-- END COL md - 9 --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table" style="font-weight: 600">
                        <tbody>
                            <tr style="background-color: #041f48; color: #fff;">
                                <td class="col-md-1">
                                    <label>Image</label>
                                </td>
                                <td class="col-md-2">
                                    <label>Product Name</label>
                                </td>
                                <td class="col-md-2">
                                    <label>Vendor Name</label>
                                </td>
                                <td class="col-md-2">
                                    <label>Product Code</label>
                                </td>
                                <td class="col-md-1">
                                    <label>Color</label>
                                </td>
                                <td class="col-md-1">
                                    <label>Size</label>
                                </td>
                                <td class="col-md-1">
                                    <label>Quantity</label>
                                </td>
                                <td class="col-md-3">
                                    <label>Price</label>
                                </td>
                            </tr>
                            @foreach($orderItem as $item)
                            <tr style="background-color: #f1f1f1;">
                                <td class="col-md-1">
                                    <label><img src="{{ asset($item->product->product_thumbnail) }}" height="80" alt=""></label>
                                </td>
                                <td class="col-md-2">
                                    <label>{{ $item->product->product_name }}</label>
                                </td>
                                @if($item->vendor_id == NULL)
                                <td class="col-md-2">
                                    <label>Owner</label>
                                </td>
                                @else 
                                <td class="col-md-2">
                                    <label>{{ $item->product->vendor->name }}</label>
                                </td>
                                @endif
                                <td class="col-md-2">
                                    <label>{{ $item->product->product_code }}</label>
                                </td>

                                @if($item->color == NULL)
                                <td class="col-md-1">
                                    <label>...</label>
                                </td>
                                @else 
                                <td class="col-md-1">
                                    <label>{{ $item->color }}</label>
                                </td>
                                @endif
                                
                                @if($item->size == NULL)
                                <td class="col-md-1">
                                    <label>...</label>
                                </td>
                                @else 
                                <td class="col-md-1">
                                    <label>{{ $item->size }}</label>
                                </td>
                                @endif
                                

                                <td class="col-md-1">
                                    <label>{{ $item->qty }}</label>
                                </td>
                                <td class="col-md-3">
                                    <label>Item Price: Rs. {{ $item->price }} <br> Total Price: Rs. {{ $item->price * $item->qty }}</label>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if($order->status !== 'delivered') 
            @else 
            {{-- START RETURN ORDER --}}
            <div class="form-group">
                <h4 for="return_reason">Order Return Reason</h4>
                <textarea class="my-3" rows="5" placeholder="Enter your reason for returning the order" name="return_reason"></textarea>
                <button type="submit" class="btn btn-danger btn-sm">Return Order</button>
            </div>
            {{-- END RETURN ORDER --}}

            @endif
        </div>
    </div>
@endsection
