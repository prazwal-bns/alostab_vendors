@extends('vendor.vendor_dashboard')
@section('vendor')

@php
    $id = Auth::user()->id;
    $vendorId = App\Models\User::find($id);
    $status = $vendorId->status;

    $customer = App\Models\User::where('status', 'active')->where('role', 'user')->get();
@endphp

    <div class="page-content">
        @if($status === 'active')
            <h2>Vendor Account is <span class="text-success mb-2">Active</span> </h2>

        @else
            <h2>Vendor Account is <span class="text-danger mb-2">Inactive</span> </h2>
            <p class="text-danger"><b>Please wait until admin approves your account.</b></p>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">Rs. {{ number_format($todaysOrder, 2) }}</h5>
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
            <div class="col">
                <div class="card radius-10 bg-gradient-moonlit">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ count($pendingOrders) }} Orders</h5>
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
        </div><!--end row-->


        <div class="row">
            <div class="col-lg-8">
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
                        <table class="table align-middle mb-0">
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
                                        @foreach ($vendorOrders as $key => $order)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $order->order_date }}</td>
                                                <td>{{ $order->user ? $order->user->name : 'N/A' }}</td>
                                                <td>{{ $order->invoice_number }}</td>
                                                <td>Rs. {{ $order->amount }}</td>
                                                <td>{{ $order->payment_method }}</td>
                                                <td>
                                                    <div class="badge bg-light-info text-danger w-80" style="font-size: 14px">
                                                        {{ $order->status }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                    </div>
                </div>
            </div>
            </div>

            {{-- CHART --}}
            @php
                use App\Models\Order;
                use Illuminate\Support\Facades\Auth;

                $months = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];

                $salesData = [];

                $vendorId = Auth::id(); // Assuming you are using Laravel's Auth facade

                foreach ($months as $month) {
                    $totalSales = Order::whereHas('orderItems', function ($query) use ($month, $vendorId) {
                        $query->where('vendor_id', $vendorId);
                    })->where('order_month', $month)->count();

                    $salesData[] = $totalSales;
                }
            @endphp

            
            
            @php
            $data = [
                'labels' => $months,
                'datasets' => [
                    [
                        'label' => 'Monthly Sales',
                        'data' => $salesData,
                        'backgroundColor' => 'rgba(51, 228, 0 , 0.5)',
                        'borderColor' => 'rgba(255, 0, 0 , 1)',
                        'borderWidth' => 2.2,
                    ],
                ],
            ];
            @endphp
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sales in Various Months</h5>
                        <canvas id="salesChart" width="500" height="500"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: @json($data), 
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(6, 45, 4, 0.2)', // Grid line color
                    },
                    ticks: {
                        color: 'black', // Y-axis label color
                    },
                    title: {
                        display: true,
                        text: 'Total Sales', // Y-axis label
                        color: 'black', // Y-axis label color
                        font: {
                            size: 14, // Y-axis label font size
                        }
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.2)', // Grid line color
                    },
                    ticks: {
                        color: 'black', // X-axis label color
                    },
                    title: {
                        display: true,
                        text: 'Months', // X-axis label
                        color: 'black', // X-axis label color
                        font: {
                            size: 14, // X-axis label font size
                        }
                    }
                }
            },
            elements: {
                line: {
                    tension: 0.4, // Adjust line tension for curve
                    borderWidth: 2, // Line width
                    borderColor: 'rgba(75, 192, 192, 1)', // Line color
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Background color
                },
                point: {
                    radius: 5, // Point radius
                    backgroundColor: 'white', // Point background color
                    borderColor: 'rgba(75, 192, 192, 1)', // Point border color
                    borderWidth: 2, // Point border width
                }
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: 'red', // Legend label color
                    }
                }
            }
        }
    });
</script>
@endsection
