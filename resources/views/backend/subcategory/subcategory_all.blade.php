@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Sub Categories</div>
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
                @if(Auth::user()->canAll('subcategory.add'))
                <a class="btn btn-success" href="{{route('add.subcategory')}}">Add Sub Category</a>
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
                            <th>Category Name</th>
                            <th>Sub Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                        <tbody>
                            @foreach ($subcategory as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item['Category']['category_name'] ?? 'N/A' }}</td>
                                    <td>{{ $item->subcategory_name }}</td>
                                    <td>
                                        @if(Auth::user()->canAll('subcategory.edit'))
                                        <a href="{{ route('edit.subcategory', $item->id) }}" class="btn btn-info">Edit</a>
                                        @endif

                                        @if(Auth::user()->canAll('subcategory.delete'))
                                        <a href="{{ route('delete.subcategory', $item->id) }}" id="delete" class="btn btn-danger">Delete</a>
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
