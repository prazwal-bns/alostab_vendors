@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Products Stock</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Total Products : <span class="badge bg-success" style="font-size: 18px;">{{count($products)}}</span></li>
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
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Discount %</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><img src="{{asset($item->product_thumbnail)}}" width="60" height="60" alt="product_img"></td>
                            <td>{{$item->product_name}}</td>
                            <td>{{$item->selling_price}}</td>
                            <td>{{$item->product_quantity}}</td>
                            <td style="font-size: 18px;"> 
                                @if($item->discount_price == NULL)
                                    <span class="badge bg-info"> No Discount </span>
                                @else
                                @php 
                                    // $amount = $item->selling_price - $item->discount_price;
                                    $discount = ($item->discount_price/$item->selling_price) * 100;
                                @endphp
                                    <span class="badge bg-danger"> {{round($discount)}} %</span>
                                @endif
                            </td>
                            <td style="font-size: 18px;"> @if($item->status ==1)
                                <span class="badge bg-success"> Active </span>
                                @else    
                                <span class="badge bg-danger"> Inactive </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
