@extends('dashboard')
@section('user')
@section('title')
    User | Track Order  
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Track Your Order
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
                                            <h4 class="text-danger">Track Your Order</h4>
                                        </div>
                                        <div class="card-body">

                                            <form action="{{ route('order.tracking') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h5 class="mb-3">Invoice Number: <span class="required">*</span></h5>
                                                        <input type="text" required="" name="code" class="form-control" placeholder="Order Invoice Number" autocomplete="off"/>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <button type="submit"
                                                            class="btn btn-fill-out submit font-weight-bold"
                                                            name="submit" value="Submit">Track Order</button>
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