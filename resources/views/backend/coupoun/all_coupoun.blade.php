@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Coupouns</div>
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
                <a class="btn btn-success" href="{{route('add.coupoun')}}">Add Coupoun</a>
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
                            <th>Coupoun Name</th>
                            <th>Coupoun Discount</th>
                            <th>Coupoun Validity</th>
                            <th>Coupoun Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                        <tbody>
                            @foreach ($coupoun as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->coupoun_name }}</td>
                                    <td>{{ $item->coupoun_discount }} %</td>
                                    <td>{{ Carbon\Carbon::parse($item->coupoun_validity)->format('D, d F Y') }}</td>
                                    <td>
                                        @if($item->coupoun_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                            <span class="badge rounded-pill bg-success">Valid</span>
                                        @else 
                                            <span class="badge rounded-pill bg-danger">InValid</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.coupoun', $item->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ route('delete.coupoun', $item->id) }}" id="delete" class="btn btn-danger">Delete</a>
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
