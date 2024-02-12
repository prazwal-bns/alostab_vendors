@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Users Data</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">User Table</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                {{-- <a class="btn btn-success" href="{{route('add.subcategory')}}">Add Sub Category</a> --}}
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>

                        <tbody>
                            @foreach ($users as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img id="showImage" src="{{ !empty($item->photo) ? url('upload/user_images/' .$item->photo) : url('upload/no_image.jpg') }}" class="rounded-circle p-1 bg-primary" alt="image" style="height: 80px;">
                                    </td>
                                    <td>{{ $item->name}}</td>
                                    <td>{{ $item->email ?? '...' }}</td>
                                    <td>{{ $item->phone ?? '...' }}</td>

                                    <td style="font-size: 18px;">
                                        @if($item->UserOnline())
                                            <span class="badge badge-pill bg-success">Active Now</span>
                                        @else 
                                            <span class="badge badge-pill bg-danger">{{ Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}</span>
                                        @endif
                                        {{-- <a href="{{ route('edit.subcategory', $item->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ route('delete.subcategory', $item->id) }}" id="delete" class="btn btn-danger">Delete</a> --}}
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
