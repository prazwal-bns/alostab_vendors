@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
<style>
.permission-container {
    max-width: 900px; /* Adjust as necessary */
    display: flex;
    flex-wrap: wrap;
}

.permission-badge {
    font-size: 12px;
    padding: 5px 10px;
    margin-right: 6px;
    margin-bottom: 15px;
}
</style>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Roles & Permission</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Roles & Permission</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-hover table-striped table-bordered">
                    <thead style="background-color: #004c36; color: #fff;">
                        <tr>
                            <th>SN</th>
                            <th>Roles Name</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{$item->name}}</td>
                            <td class="permission-container">
                            @foreach($item->permissions as $perm)
                                <span class="badge bg-danger permission-badge">{{ $perm->name }}</span>
                            @endforeach
                                {{-- @foreach($item->permissions as $perm)
                                    <span class="badge rounded-pill bg-danger">{{ $perm->name }}</span>
                                @endforeach --}}
                            </td>
                            <td>
                                <a href="{{route('admin.edit.roles', $item->id)}}" class="btn btn-info">Edit</a>
                                <a href="{{ route('admin.delete.roles',$item->id) }}" id="delete" class="btn btn-danger">Delete</a>
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
