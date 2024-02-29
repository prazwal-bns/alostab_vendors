@extends('dashboard')
@section('user')
@section('title')
    Order | Tracking  
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .card{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0, 0, 0, 0.1);border-radius: 0.10rem}.card-header:first-child{border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0}.card-header{padding: 0.75rem 1.25rem;margin-bottom: 0;background-color: #fff;border-bottom: 1px solid rgba(0, 0, 0, 0.1)}.track{position: relative;background-color: #ddd;height: 7px;display: -webkit-box;display: -ms-flexbox;display: flex;margin-bottom: 60px;margin-top: 50px}.track .step{-webkit-box-flex: 1;-ms-flex-positive: 1;flex-grow: 1;width: 25%;margin-top: -18px;text-align: center;position: relative}.track .step.active:before{background: #3BB77E}.track .step::before{height: 7px;position: absolute;content: "";width: 100%;left: 0;top: 18px}.track .step.active .icon{background: #3BB77E;color: #fff}.track .icon{display: inline-block;width: 40px;height: 40px;line-height: 40px;position: relative;border-radius: 100%;background: #ddd}.track .step.active .text{font-weight: 400;color: #000}.track .text{display: block;margin-top: 7px}.itemside{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;width: 100%}.itemside .aside{position: relative;-ms-flex-negative: 0;flex-shrink: 0}.img-sm{width: 80px;height: 80px;padding: 7px}ul.row, ul.row-sm{list-style: none;padding: 0}.itemside .info{padding-left: 15px;padding-right: 7px}.itemside .title{display: block;margin-bottom: 5px;color: #212529}p{margin-top: 0;margin-bottom: 1rem}.btn-warning{color: #ffffff;background-color: #3BB77E;border-color: #3BB77E;border-radius: 1px}.btn-warning:hover{color: #ffffff;background-color: #ff2b00;border-color: #ff2b00;border-radius: 1px}
</style>

<div class="container">
    <article class="card">
        <h6 class="card-header"> Order | Tracking </h6>
        <div class="card-body">
            <h5 class="mb-2 text-danger">Order ID: {{ $track->invoice_number }}</h5>
            <article class="card">
                <div class="card-body row">
                    <div class="col"><h5>Order Date: </h5><br><h6>{{ $track->order_date }} </h6></div>
                    <div class="col"><h5>Order By: </h5><br><h6>{{ $track->name }}</h6></div>
                    <div class="col"><h5>Payment Method: </h5><br><h6> {{ $track->payment_method }} </h6></div>
                    <div class="col"><h5>Total Amount: </h5><br><h6> Rs. {{ $track->amount }} </h6></div>
                    <div class="col"><h5>Contact No: </h5><br><h6><i class="fa fa-phone"></i> {{ !empty($track->phone) ? $track->phone : '...' }}</h6></div>
                    <div class="col"><h5>Address: </h5><br><h6> <i class="fa fa-address-card"></i> {{ $track->City->city_name }}/{{ $track->District->district_name }}/{{ $track->State->state_name }} </h6></div>
                </div>
            </article>

            <div class="track">
                {{-- <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Pending</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Order Confirmed</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Order Processing</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div> --}}

                @if($track->status == 'pending')           
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Pending</span> </div>

                <div class="step"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Order Confirmed</span> </div>

                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Order Processing </span> </div>

                <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered </span> </div>

                @elseif($track->status == 'confirm')

                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Pending</span> </div>

                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Order Confirmed</span> </div>

                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Order Processing </span> </div>

                <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered </span> </div>

                @elseif($track->status == 'processing')

                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Pending</span> </div>

                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Order Confirmed</span> </div>

                <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Order Processing </span> </div>

                <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered </span> </div>

                @elseif($track->status == 'delivered')

                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Pending</span> </div>

                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Order Confirmed</span> </div>

                <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Order Processing </span> </div>

                <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered </span> </div>

                @endif
            </div>
            <hr>
            <a href="{{ route('user.track.order') }}" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a>
        </div>
    </article>
</div>

@endsection