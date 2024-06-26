@extends('vendor.vendor_dashboard')
@section('vendor')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vendor Pending Orders</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Orders</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-hover table-bordered">
                    <thead style="background-color: #004c36; color: #fff;">
                        <tr>
                            <th>SN</th>
                            <th>Date</th>
                            <th>Invoice No.</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItems as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{$item['Order']['order_date']}}</td>
                            <td>{{$item['Order']['invoice_number']}}</td>
                            <td>Rs. {{$item['Order']['amount']}}</td>
                            <td>{{$item['Order']['payment_method']}}</td>

                            {{-- <td style="font-size: 18px">
                                
                                <span class="badge bg-success">{{$item['Order']['status']}}</span>
                            </td> --}}
                            <td style="font-size: 18px">
                                @if($item['Order']['status'] == 'pending')
                                    <span class="badge bg-danger">{{$item['Order']['status']}}</span>
                                @elseif($item['Order']['status'] == 'confirm')
                                    <span class="badge bg-primary">{{$item['Order']['status']}}</span>
                                @elseif($item['Order']['status'] == 'processing')
                                    <span class="badge bg-info">{{$item['Order']['status']}}</span>
                                @elseif($item['Order']['status'] == 'delivered')
                                    <span class="badge bg-success">{{$item['Order']['status']}}</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('vendor.order.details', $item->order->id) }}" class="btn btn-info"><i class="fa fa-eye" title="Details"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        {{-- <tr>
                            <th>SN</th>
                            <th>Brand Name</th>
                            <th>Brand Image</th>
                            <th>Action</th>
                        </tr> --}}
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
