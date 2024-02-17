@extends('dashboard')
@section('user')

@section('title')
    Change Password  
@endsection

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Change Password
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
                                            <h5>Change Password</h5>
                                        </div>
                                        <div class="card-body">

                                            <form action="{{ route('user.update.password') }}" method="POST">
                                                @csrf
                                                @if (session('status'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ session('status') }}
                                                    </div>
                                                @elseif(session('error'))
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Old Password <span class="required">*</span></label>
                                                        <input type="password" name="old_password"
                                                            class="form-control @error('old_password') is-invalid @enderror"
                                                            id="current_password" placeholder="Old Password" />

                                                        @error('old_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>New Password <span class="required">*</span></label>
                                                        <input type="password" name="new_password"
                                                            class="form-control @error('new_password') is-invalid @enderror"
                                                            id="new_password" placeholder="New Password" />

                                                        @error('new_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Confirm Password <span class="required">*</span></label>
                                                        <input type="password" name="new_password_confirmation"
                                                            class="form-control" id="new_password_confirmation"
                                                            placeholder="Confirm New Password" />
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
@endsection
