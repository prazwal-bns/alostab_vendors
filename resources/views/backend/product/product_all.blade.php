@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Products</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Total Products : <span class="badge bg-success" style="font-size: 18px;">{{count($products)}}</span></li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                @if(Auth::user()->canAll('product.add'))
                <a class="btn btn-success" href="{{route('add.product')}}">Add Product</a>
                @endif
            </div>
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
                            <th>Action</th>
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
                            <td> 
                                @if($item->discount_price == NULL)
                                    <span class="badge rounded-pill bg-info"> No Discount </span>
                                @else
                                @php 
                                    // $amount = $item->selling_price - $item->discount_price;
                                    $discount = ($item->discount_price/$item->selling_price) * 100;
                                @endphp
                                    <span class="badge bg-danger" style="font-size: 12px;"> {{round($discount)}} %</span>
                                @endif
                            </td>
                            <td> @if($item->status ==1)
                                <span class="badge rounded-pill bg-success"> Active </span>
                                @else    
                                <span class="badge rounded-pill bg-danger"> Inactive </span>
                                @endif
                            </td>
                            <td>
                                @if(Auth::user()->canAll('product.edit'))
                                <a href="{{route('edit.product', $item->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                @endif

                                @if(Auth::user()->canAll('product.delete'))
                                <a href="{{route('delete.product', $item->id)}}" id="delete" class="btn btn-danger" title="Delete Data"><i class="fa fa-trash"></i></a>
                                @endif

                                {{-- <a href="" class="btn btn-warning" title="Details"><i class="fa fa-eye"></i></a> --}}
                                
                                @if($item->status ==1)
                                    <a href="{{route('inactive.product', $item->id)}}" class="btn btn-danger" title="Inactive"><i class="fa-solid fa-thumbs-down"></i></a>
                                @else
                                <a href="{{route('active.product', $item->id)}}" class="btn btn-success" title="Inactive"><i class="fa-solid fa-thumbs-up"></i></a>
                                @endif
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
