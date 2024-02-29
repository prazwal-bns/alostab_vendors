@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Brands</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                @if(Auth::user()->canAll('brand.add'))
                <a class="btn btn-success" href="{{route('add.brand')}}">Add brand</a>
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
                            <th>Brand Name</th>
                            <th>Brand Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{$item->brand_name}}</td>
                            <td><img src="{{asset($item->brand_image)}}" width="75" alt="brand_img"></td>
                            <td>
                                @if(Auth::user()->canAll('brand.edit'))
                                <a href="{{route('edit.brand', $item->id)}}" class="btn btn-info">Edit</a>
                                @endif

                                @if(Auth::user()->canAll('brand.delete'))
                                <a href="{{route('delete.brand', $item->id)}}" id="delete" class="btn btn-danger">Delete</a>
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
