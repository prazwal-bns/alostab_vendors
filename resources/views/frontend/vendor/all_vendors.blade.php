@extends('frontend.master_dashboard')
@section('main')

@section('title')
    All Vendor | Page  
@endsection

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Vendor Lists
        </div>
    </div>
</div>
<div class="page-content pt-50">
    <div class="container">
        <div class="archive-header-2 text-center">
            <h1 class="display-2 mb-50">Vendors List</h1>
        </div>
        <div class="row mb-50">
            <div class="col-12 col-lg-8 mx-auto">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We have <strong class="text-brand">{{ count($vendors) }}</strong> vendors now</p>
                    </div>
                </div>
            </div>
        </div>



        <div class="row vendor-grid">
            @foreach($vendors as $vendor)
                <div class="col-lg-3 col-md-6 col-12 col-sm-6 justify-content-center">
            <div class="vendor-wrap mb-40">
                <div class="vendor-img-action-wrap">
                    <div class="vendor-img">
                        <a href="{{ route('vendor.details',$vendor->id) }}">
                            <img class="default-img"
                                src = "{{ (!empty($vendor->photo)) ? url('upload/vendor_images/'.$vendor->photo) : url('upload/no_image.jpg') }} "
                                alt="" style="height: 120px;" />
                        </a>
                    </div>
                    <div class="product-badges product-badges-position product-badges-mrg">
                        <span class="hot">Shop</span>
                    </div>
                </div>
                <div class="vendor-content-wrap">
                    <div class="d-flex justify-content-between align-items-end mb-30">
                        <div>
                            <div class="product-category">
                                <span class="text-muted">Since {{ $vendor->vendor_join }}</span>
                            </div>
                            <h4 class="mb-5"><a href="{{ route('vendor.details',$vendor->id) }}">{{ $vendor->name }}</a></h4>
                            <div class="product-rate-cover">
                                @php
                                    $products = App\Models\Product::where('vendor_id',$vendor->id)->get();
                                @endphp
                                <span class="font-small total-product">{{ count($products )}} Products</span>
                            </div>
                        </div>

                    </div>
                    <div class="vendor-info mb-30">
                        <ul class="contact-infor text-muted">

                            <li><img src = "{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" />
                            <strong>Call Us:</strong><span>(+977)- {{ $vendor->phone }}</span></li>
                             <li><img src = "{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="" />
                            <strong>Address: </strong><span>{{ $vendor->address }}</span></li>
                        </ul>
                    </div>
                    <a href="{{ route('vendor.details',$vendor->id) }}" class="btn btn-xs">Visit Store <i
                            class="fi-rs-arrow-small-right"></i></a>
                </div>
            </div>
        </div>
            @endforeach
            <!--end vendor card-->
        </div>
       
    </div>
</div>
@endsection
