@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Order Report by Year</div>
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
    <h4>Report Date: {{ $year }}</h4>
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
                        @foreach ($orders as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{$item->order_date}}</td>
                            <td>{{$item->invoice_number}}</td>
                            <td>Rs. {{$item->amount}}</td>
                            <td>{{$item->payment_method}}</td>
                            {{-- <td style="font-size: 18px"><span class="badge" style="background: rgb(138, 0, 138);">{{$item->status}}</span></td>
                             --}}
                            <td style="font-size: 18px">
                                @if($item->status == 'pending')
                                    <span class="badge bg-warning text-dark">{{$item->status}}</span>
                                @elseif($item->status == 'confirm')
                                    <span class="badge bg-info text-dark">{{$item->status}}</span>
                                @elseif($item->status == 'processing')
                                    <span class="badge bg-danger">{{$item->status}}</span>
                                @elseif($item->status == 'delivered')
                                    <span class="badge bg-success">{{$item->status}}</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.order.details',$item->id) }}" class="btn btn-info"><i class="fa fa-eye" title="Details"></i></a>
                                <a href="{{ route('admin.invoice.download',$item->id) }}" class="btn btn-danger"><i class="fa fa-download" title="Download Invoice"></i></a>
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
