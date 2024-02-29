@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Banners</div>
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
                @if(Auth::user()->canAll('ads.add'))
                <a class="btn btn-success" href="{{route('add.banner')}}">Add Banner</a>
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
                            <th>Banner Title</th>
                            <th>Banner URL</th>
                            <th>Banner Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{$item->banner_title}}</td>
                            <td>{{$item->banner_url}}</td>
                            <td><img src="{{asset($item->banner_image)}}" width="200" alt="banner_img"></td>
                            <td>
                                 @if(Auth::user()->canAll('ads.edit'))
                                <a href="{{route('edit.banner', $item->id)}}" class="btn btn-info">Edit</a>
                                @endif

                                @if(Auth::user()->canAll('ads.delete'))
                                <a href="{{route('delete.banner', $item->id)}}" id="delete" class="btn btn-danger">Delete</a>
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
