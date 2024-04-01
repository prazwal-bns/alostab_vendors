@extends('dashboard')
@section('user')

@section('title')
   Return | Order 
@endsection

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" >
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
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

                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Returned Orders</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                @if($orders->isEmpty())
                                                    <p>No Data Available</p>
                                                @else
                                                    <table class="table" style="background: #f1f1f1; font-weight:600;">
                                                        <thead style="background-color: #041f48; color: #fff;">
                                                            <tr>
                                                                <th>SN</th>
                                                                <th>Date</th>
                                                                <th>Total</th>
                                                                <th>Payment</th>
                                                                <th>Invoice No.</th>
                                                                <th>Return Reason.</th>
                                                                <th>Status</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($orders as $key=> $order)
                                                            <tr>
                                                                <td>{{ $key+1 }}</td>
                                                                <td>{{ $order->order_date }}</td>
                                                                <td>Rs. {{ $order->amount }}</td>
                                                                <td>{{ $order->payment_method }}</td>
                                                                <td>{{ $order->invoice_number }}</td>
                                                                <td>{{ $order->return_reason }}</td>

                                                                <td style="font-size: 18px">
                                                                    @if ($order->return_order == 0)
                                                                        <span class="badge badge-pill bg-warning"> No Return Request </span>
                                                                    @elseif ($order->return_order == 1)
                                                                        <span class="badge" style="background: rgb(210, 38, 4);">Return Pending</span>
                                                                    @elseif ($order->return_order == 2)
                                                                        <span class="badge badge-pill" style="background: rgb(0, 192, 41);">Return Success</span>

                                                                    @endif

                                                                    
                                                                </td>
                                                                
                                                                <td>
                                                                    <a href="{{ url('user/order_details/'.$order->id) }}" class="btn-sm btn-success"><i class="fa fa-eye"></i> View</a>
                                                                    <a href="{{ url('user/invoice_download/'.$order->id) }}" class="btn-sm btn-danger"><i class="fa fa-download"></i> Invoice</a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <!-- Pagination links -->
                                                    <div class="d-flex justify-content-end">
                                                        {{ $orders->links() }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
