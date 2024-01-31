@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Coupoun </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Coupoun</li>
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

                                <form id="myForm" action="{{ route('store.coupoun') }}" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Coupoun Name:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary form-group">
                                            <input id="coupounTitle" type="text" name="coupoun_name"
                                                class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Coupoun Discount(%):</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary form-group">
                                            <input id="discount" type="number" placeholder="%" name="coupoun_discount" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Coupoun Validity (Date):</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary form-group">
                                            <input id="validity" type="date" placeholder="%" name="coupoun_validity" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" />
                                        </div>
                                    </div>

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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    coupoun_name: {
                        required: true,
                    },
                    coupoun_discount: {
                        required: true,
                    },
                    coupoun_validity: {
                        required: true,
                    },
                },
                messages: {
                    coupoun_name: {
                        required: 'Please Enter Coupoun Name',
                    },
                    coupoun_discount: {
                        required: 'Please Enter Coupoun Discount %',
                    },
                    coupoun_validity: {
                        required: 'Please Enter Coupoun Validity Date',
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
