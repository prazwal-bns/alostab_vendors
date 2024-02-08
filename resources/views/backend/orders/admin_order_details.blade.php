@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin Order Details</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Orders</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
            <div class="col">
                <div class="card">
                    <div class="card-header pt-4">
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
            <div class="col">
                <div class="card">
                    <div class="card-header pt-4">
                        <h4>Order Details:
                            <hr><u class="text-danger">Invoice No:<span class="text-danger">
                                    {{ $order->invoice_number }}</span></u>
                        </h4>
                        <div class="card-body">
                            <table class="table" style="font-weight: 600;">
                                <tr>
                                    <th>Name:</th>
                                    <th>{{ $order->name }}</th>
                                </tr>

                                <tr>
                                    <th>Phone:</th>
                                    <th>{{ $order->phone }}</th>
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
                                        <span style="font-weight: 400; font-size: 15px;" class="badge rounded-pill bg-info"> {{ $order->status }} </span>
                                    </th>
                                </tr>
                                <tr>
                                    {{-- <th>Action:</th> --}}
                                    <th></th>
                                    <th style="font-weight: 400;">
                                        @if($order->status == 'pending') 
                                            <a href="{{ route('pendingTo.Confirm',$order->id) }}" id="confirm" class="btn btn-block btn-primary">Confirm Order</a>
                                        @elseif($order->status == 'confirm') 
                                            <a href="{{ route('confirmTo.Processing',$order->id) }}" class="btn btn-block btn-warning" id="processing">Processing Order</a>
                                        @elseif($order->status == 'processing') 
                                            <a href="{{ route('processingTo.Delivered',$order->id) }}" class="btn btn-block btn-success" id="delivered">Deliver Order</a>
                                        @endif
                                    </th>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
            <div class="col">
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
        </div>

    </div>
@endsection
