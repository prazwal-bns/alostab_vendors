@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Admin User</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Admin User</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('admin.user.store') }}" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">User Name:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="username" class="form-control"  placeholder="Enter User Name"/>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Full Name:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="name" class="form-control"  placeholder="Add Full Name"/>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="email" name="email" class="form-control"  placeholder="Add Your Email"/>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone No:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="number" name="phone" class="form-control"  placeholder="Add Your Phone No."/>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Address:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="address" class="form-control"  placeholder="Add Your Address."/>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Password:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="password" name="password" class="form-control"  placeholder="Password"/>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Assign Role:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select name="roles" class="form-select mb-3" aria-label="Select Form">
                                                <option>Select Role</option>

                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-success px-3" value="Save Changes" />
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


    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    username: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true, // Validate email format
                    },
                    phone: {
                        required: true,
                        // Add additional validation rules for phone number if needed
                    },
                    address: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 6, // Example: Minimum length of password
                    },
                    roles: {
                        required: true,
                    },
                },
                messages: {
                    username: {
                        required: 'Please Enter User Name',
                    },
                    name: {
                        required: 'Please Enter Your Name',
                    },
                    email: {
                        required: 'Please Enter Email Address',
                        email: 'Please Enter a Valid Email Address',
                    },
                    phone: {
                        required: 'Please Enter Phone Number',
                    },
                    address: {
                        required: 'Please Enter Address',
                    },
                    password: {
                        required: 'Please Enter Password',
                        minlength: 'Password must be at least 6 characters long',
                    },
                    roles: {
                        required: 'Please Select Role',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });

    </script>
@endsection
