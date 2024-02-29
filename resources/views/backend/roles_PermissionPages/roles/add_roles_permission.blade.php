@extends('admin.admin_dashboard')
@section('admin')
<style>
.form-check-label{
    text-transform: capitalize;
}
</style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Roles Permission</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Role Permission</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">

                                <form id="myForm" action="{{ route('store.role.permission') }}" method="POST">
                                    @csrf
                                    <div class="row mb-2">
                                        <div class="col-sm-3">
                                            <h5 class="mb-0">Roles Name:</h5>
                                        </div>
                                        <div class="col-sm-9 text-secondary form-group">

                                           <select class="form-select mb-3" name="role_id" aria-label="Default select example">
                                                <option selected="">Select Role Name</option>
                                                @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                     <div class="form-check" style="font-size: 16px; font-weight: bolder;">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultAll">
                                        <label class="form-check-label" style="font-weight: bolder; color:red;" for="flexCheckDefaultAll">Grant All Permission</label>
                                    </div>
                                    <hr>

                                    {{-- START ROW --}}
                                    @foreach($permission_groups as $group)
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-check">
                                                {{-- <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> --}}
                                                <label style="font-weight: bolder;" class="form-check-label" for="flexCheckDefault">{{ $group->group_name }}</label>
                                            </div>
                                        </div>

                                        <div class="col-9">
                                            @php
                                                $permissions = App\Models\User::getPermissionByGroupName($group->group_name);   
                                            @endphp
                                    
                                            @foreach($permissions as $permission)
                                            <div class="form-check">
                                                <input class="form-check-input" name="permission[]" type="checkbox" value="{{ $permission->id }}" id="flexCheckDefault{{$permission->id}}">
                                                <label class="form-check-label" for="flexCheckDefault{{$permission->id}}">{{ $permission->name }}</label>
                                            </div>
                                            @endforeach
                                            <br>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{-- END ROW --}}



                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-3" value="Save Changes" />
                                        </div>
                                    </div>
                            </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $('#flexCheckDefaultAll').click(function(){
        if($(this).is(':checked')){
            $('input[type = checkbox]').prop('checked',true);
        }
        else{
            $('input[type = checkbox]').prop('checked',false);
        }
    });
</script>

@endsection
