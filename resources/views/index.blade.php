@extends('dashboard')
@section('user')

@section('title')
   My Account 
@endsection

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> My Account
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
                                            <h3 class="mb-0">Hello {{ Auth::user()->name }}</h3>
                                            <br>
                                            <img id="showImage"
                                                src="{{ !empty($userData->photo) ? url('upload/'.$userData->role.'_images/'.$userData->photo) : url('upload/no_image.jpg') }}" alt="User Image" class="rounded-circle p-1 bg-primary" width="130">
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                From your account dashboard. you can easily check &amp; view your <a
                                                    href="{{ route('user.order.page') }}">recent orders</a>,<br />
                                                return defected <a href="{{ route('return.order.page') }}">products</a> and <a href="{{ route('user.change.password') }}">edit your password </a> and <a href="{{ route('user.account.page') }}"> account details.</a>
                                            </p>
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
