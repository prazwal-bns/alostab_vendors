@extends('dashboard')
@section('user')

@section('title')
    Account | Details  
@endsection

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> User Account
            </div>
        </div>
    </div>
    <div class="page-content pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="row">
                        {{-- START MENU MD -3 --}}
                        @include('frontend.body.dashboard_sidebar_menu')
                        {{-- END MENU MD -3 --}}

                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">

                                            <form action="{{ route('user.profile.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>User Name <span class="required">*</span></label>
                                                    @if ($userData->username)
                                                        <input class="form-control" value="{{ $userData->username }}" name="username" type="text" />
                                                    @else
                                                        @php
                                                            $username = strtolower(str_replace(' ', '', $userData->name));
                                                        @endphp
                                                        <input class="form-control" value="{{ $username }}" name="username" type="text" />
                                                    @endif
                                                </div>


                                                    <div class="form-group col-md-6">
                                                        <label>Full Name <span class="required">*</span></label>
                                                        <input class="form-control" value="{{ $userData->name }}"
                                                            name="name" />
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input class="form-control" value="{{ $userData->email }}"
                                                            name="email" type="email" />
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Phone No <span class="required">*</span></label>
                                                        <input class="form-control" value="{{ $userData->phone }}"
                                                            name="phone" type="number" />
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Address <span class="required">*</span></label>
                                                        <input class="form-control" value="{{ $userData->address }}"
                                                            name="address" type="address" />
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>User Photo <span class="required">*</span></label>
                                                        <input class="form-control" name="photo" type="file"
                                                            id="image" />
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label> <span class="required">*</span></label>
                                                        <img id="showImage"
                                                            src="{{ !empty($userData->photo) ? url('upload/'.$userData->role.'_images/'.$userData->photo) : url('upload/no_image.jpg') }}"
                                                            alt="User" class="rounded-circle p-1 bg-primary"
                                                            width="110">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <button type="submit"
                                                            class="btn btn-fill-out submit font-weight-bold"
                                                            name="submit" value="Submit">Save Change</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>
@endsection
