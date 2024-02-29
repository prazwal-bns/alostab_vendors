@extends('admin.admin_dashboard')
@section('admin')

@php
    $date = date('d F Y');
    $today_order = App\Models\Order::where('order_date',$date)->where('return_order',0)->sum('amount');

    $month = date('F');
    $monthly_order = App\Models\Order::where('order_month',$month)->where('return_order',0)->sum('amount');

    $year = date('Y');
    $yearly_order = App\Models\Order::where('order_year',$year)->where('return_order',0)->sum('amount');

    $totalRevenue = App\Models\Order::where('return_order',0)->sum('amount');

    $pending = App\Models\Order::where('status','pending')->get();

    $returnRequestedOrders = App\Models\Order::where('return_order','1')->get();

    $vendor = App\Models\User::where('status','active')->where('role','vendor')->get();

    $customer = App\Models\User::where('status','active')->where('role','user')->get();
@endphp

    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">Rs. {{ number_format($today_order, 2) }}</h5>
                            <div class="ms-auto">
                                {{-- <i class='bx bx-cart fs-3 text-white'></i> --}}
                                <i class='bx bx-dollar fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 35%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Today's Sale</p>
                            {{-- <p class="mb-0 ms-auto">+4.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-gradient-ohhappiness">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">Rs. {{ number_format($monthly_order, 2) }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-dollar fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 65%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Monthly Sale</p>
                            {{-- <p class="mb-0 ms-auto">+1.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-gradient-ohhappiness">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">Rs. {{ number_format($yearly_order, 2) }}</h5>
                            <div class="ms-auto">
                                {{-- <i class='bx bx-group fs-3 text-white'></i> --}}
                                <i class='bx bx-dollar fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 75%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Yearly Sale</p>
                            {{-- <p class="mb-0 ms-auto">+5.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-gradient-ohhappiness">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">Rs. {{ number_format($totalRevenue, 2) }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-dollar fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 68%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Total Revenue</p>
                            {{-- <p class="mb-0 ms-auto">+5.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-gradient-moonlit">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ count($pending) }} Orders</h5>
                            <div class="ms-auto">
                                {{-- <i class='bx bx-envelope fs-3 text-white'></i> --}}
                                <i class='bx bx-cart fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 40%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Pending Orders</p>
                            {{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-gradient-burning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ count($vendor) }} Vendors</h5>
                            <div class="ms-auto">
                                <i class='bx bx-group fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 45%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Total Vendors</p>
                            {{-- <p class="mb-0 ms-auto">+5.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 bg-gradient-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ count($customer) }} Customer</h5>
                            <div class="ms-auto">
                                <i class='bx bx-group fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 65%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Total Customers</p>
                            {{-- <p class="mb-0 ms-auto">+5.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 split-bg-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ count($returnRequestedOrders) }} Request</h5>
                            <div class="ms-auto">
                                {{-- <i class='bx bx-envelope fs-3 text-white'></i> --}}
                                <i class='bx bx-cart fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 30%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Returned Requested Orders</p>
                            {{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                        </div>
                    </div>
                </div>
            </div>

        </div><!--end row-->

        @php
            $orders = App\Models\Order::where('status','pending')->orderBy('id','DESC')->limit(10)->get();   
        @endphp

        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Orders Summary</h5>
                    </div>
                    <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 ">
                        <thead class="table-dark">
                            <tr>
                                <th>SN</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Invoice No.</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $order->user ? $order->user->name : 'N/A' }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->invoice_number }}</td>
                                <td>Rs. {{ $order->amount }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>
                                    <div class="badge bg-light-info text-danger w-80" style="font-size: 14px">{{ $order->status }}
                                    </div>
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
