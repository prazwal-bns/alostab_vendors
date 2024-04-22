@extends('frontend.master_dashboard')
@section('main')

@section('title')
    {{ $product->product_name }} | Product
@endsection

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> <a href="">{{ ucwords($product['category']['category_name']) }}</a>
            <span></span>{{ ucwords($product['subcategory']['subcategory_name']) }}<span></span>{{ ucwords($product->product_name) }}
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="row">
        <div class="col-xl-10 col-lg-12 m-auto">
            <div class="product-detail accordion-detail">
                <div class="row mb-50 mt-30">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                            <!-- MAIN SLIDES -->
                            <div class="product-image-slider">

                                @foreach ($multiImage as $image)
                                    <figure class="border-radius-10">
                                        <img src="{{ asset($image->photo_image) }}" alt="product image" />
                                    </figure>
                                @endforeach

                            </div>
                            <!-- THUMBNAILS -->
                            <div class="slider-nav-thumbnails">
                                @foreach ($multiImage as $image)
                                    <div><img src="{{ asset($image->photo_image) }}" alt="product image" /></div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">
                            @if ($product->product_quantity > 0)
                                <span class="stock-status in-stock"> Stock In </span>
                            @else
                                <span class="stock-status out-stock"> Stock Out </span>
                            @endif


                            <h2 class="title-detail" id="dpname">{{ ucwords($product->product_name) }}</h2>
                            <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">

                                    @php
                                        $reviewCount = App\Models\Review::where('product_id', $product->id)
                                            ->where('status', 1)
                                            ->latest()
                                            ->get();
                                        $average = App\Models\Review::where('product_id', $product->id)
                                            ->where('status', 1)
                                            ->avg('rating');
                                    @endphp

                                    <div class="product-rate d-inline-block">
                                        @if ($average == 0)
                                        @elseif($average == 1 || $average < 2)
                                            <div class="product-rating" style="width: 20%"></div>
                                        @elseif($average == 2 || $average < 3)
                                            <div class="product-rating" style="width: 40%"></div>
                                        @elseif($average == 3 || $average < 4)
                                            <div class="product-rating" style="width: 60%"></div>
                                        @elseif($average == 4 || $average < 5)
                                            <div class="product-rating" style="width: 80%"></div>
                                        @elseif($average == 5 || $average < 5)
                                            <div class="product-rating" style="width: 100%"></div>
                                        @endif
                                    </div>
                                    <span class="font-small ml-5 text-muted"> {{ count($reviewCount) }} reviews</span>
                                </div>
                            </div>
                            <div class="clearfix product-price-cover">

                                @php
                                    $amount = $product->selling_price - $product->discount_price;
                                    $discount = ($product->discount_price / $product->selling_price) * 100;
                                @endphp


                                @if ($product->discount_price == null)
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">Rs.
                                            {{ $product->selling_price % 1 === 0 ? number_format($product->selling_price) : number_format($product->selling_price, 2, '.', ',') }}</span>
                                    </div>
                                @else
                                    @php
                                        $discountedPrice = $product->selling_price - $product->discount_price;
                                        $discountPercentage = round(($product->discount_price / $product->selling_price) * 100);
                                    @endphp
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">Rs.
                                            {{ $discountedPrice % 1 === 0 ? number_format($discountedPrice) : number_format($discountedPrice, 2, '.', ',') }}</span>
                                        <span>
                                            <span
                                                class="save-price font-md color3 ml-15">{{ $discountPercentage }}%</span>
                                            <span class="old-price font-md ml-15">Rs.
                                                {{ $product->selling_price % 1 === 0 ? number_format($product->selling_price) : number_format($product->selling_price, 2, '.', ',') }}</span>
                                        </span>
                                    </div>
                                @endif


                            </div>
                            <div class="short-desc mb-30">
                                <p class="font-lg" style="text-align: justify">{{ $product->short_desc }}</p>
                            </div>

                            @if ($product->product_size == null)
                            @else
                                <div class="attr-detail attr-size mb-30">
                                    <strong class="mr-10">Size: </strong>
                                    <select name="" class="form-control unicase-form-control" id="dsize">
                                        @foreach ($product_size as $size)
                                            <option value="{{ $size }}">{{ ucwords($size) }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            @endif

                            @if ($product->product_color == null)
                            @else
                                <div class="attr-detail attr-size mb-30">
                                    <strong class="mr-10">Color: </strong>
                                    <select name="" class="form-control unicase-form-control" id="dcolor">
                                        @foreach ($product_color as $color)
                                            <option value="{{ $color }}">{{ ucwords($color) }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            @endif
                            <div class="detail-extralink mb-50">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>

                                    <input type="text" name="quantity" id="dqty" class="qty-val" value="1"
                                        min="1">

                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">

                                    <input type="hidden" id="dproduct_id" value="{{ $product->id }}">
                                    <input type="hidden" id="vproduct_id" value="{{ $product->vendor_id }}">


                                    <button type="submit" class="button button-add-to-cart"
                                        onClick="addToCartDetails()"><i class="fi-rs-shopping-cart"></i>Add to
                                        cart</button>

                                    <a aria-label="Add To Wishlist" class="action-btn hover-up" href=""><i
                                            class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn hover-up" href=""><i
                                            class="fi-rs-shuffle"></i></a>
                                </div>
                            </div>

                            @if ($product->vendor_id == null)
                                <h5 class="mb-5">Sold By: <a href="#"><span
                                            class="text-danger">Owner</span></a>
                                </h5>
                                <hr>
                            @else
                                <h5 class="mb-2">Sold By: <a href="#"><span
                                            class="text-danger">{{ ucwords($product['vendor']['name']) }}</span></a>
                                </h5>
                                <hr>
                            @endif

                            <div class="font-xs">
                                <ul class="mr-50 float-start">
                                    <li class="mb-5"><strong style="font-size: 115%">Brand:</strong> <span
                                            class="text-brand"
                                            style="font-size: 110%">{{ ucwords($product['brand']['brand_name']) }}</span>
                                    </li>
                                    <li class="mb-5"><strong style="font-size: 115%">Category:</strong> <span
                                            class="text-brand"
                                            style="font-size: 110%">{{ ucwords($product['category']['category_name']) }}</span>
                                    </li>
                                    <li><strong style="font-size: 115%">SubCategory:</strong> <span class="text-brand"
                                            style="font-size: 110%">{{ ucwords($product['subcategory']['subcategory_name']) }}</span>
                                    </li>
                                </ul>
                                <ul class="float-start">
                                    <li class="mb-5"><strong style="font-size: 115%">Product Code:</strong> <a
                                            href="#">{{ $product->product_code }}</a></li>
                                    <li class="mb-5"><strong style="font-size: 115%">Tags:</strong> <a
                                            href="#" rel="tag">{{ $product->product_tags }}</a></li>
                                    <li><strong style="font-size: 115%">Stock:</strong> <span
                                            class="in-stock text-brand ml-5">({{ $product->product_quantity }}) Items
                                            in stock</span></li>
                                </ul>
                            </div>


                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
                <div class="product-info">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs text-uppercase">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                    href="#Description">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab"
                                    href="#Vendor-info">Vendor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews
                                    ({{ count($reviewCount) }})</a>
                            </li>
                        </ul>
                        <div class="tab-content shop_info_tab entry-main-content">
                            <div class="tab-pane fade show active" id="Description">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        {!! $product->long_desc !!}
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="tab-pane fade" id="Additional-info">
                                <table class="font-md">
                                    <tbody>
                                        <tr class="stand-up">
                                            <th>Stand Up</th>
                                            <td>
                                                <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                            </td>
                                        </tr>
                                        <tr class="folded-wo-wheels">
                                            <th>Folded (w/o wheels)</th>
                                            <td>
                                                <p>32.5″L x 18.5″W x 16.5″H</p>
                                            </td>
                                        </tr>
                                        <tr class="folded-w-wheels">
                                            <th>Folded (w/ wheels)</th>
                                            <td>
                                                <p>32.5″L x 24″W x 18.5″H</p>
                                            </td>
                                        </tr>
                                        <tr class="door-pass-through">
                                            <th>Door Pass Through</th>
                                            <td>
                                                <p>24</p>
                                            </td>
                                        </tr>
                                        <tr class="frame">
                                            <th>Frame</th>
                                            <td>
                                                <p>Aluminum</p>
                                            </td>
                                        </tr>
                                        <tr class="weight-wo-wheels">
                                            <th>Weight (w/o wheels)</th>
                                            <td>
                                                <p>20 LBS</p>
                                            </td>
                                        </tr>
                                        <tr class="weight-capacity">
                                            <th>Weight Capacity</th>
                                            <td>
                                                <p>60 LBS</p>
                                            </td>
                                        </tr>
                                        <tr class="width">
                                            <th>Width</th>
                                            <td>
                                                <p>24″</p>
                                            </td>
                                        </tr>
                                        <tr class="handle-height-ground-to-handle">
                                            <th>Handle height (ground to handle)</th>
                                            <td>
                                                <p>37-45″</p>
                                            </td>
                                        </tr>
                                        <tr class="wheels">
                                            <th>Wheels</th>
                                            <td>
                                                <p>12″ air / wide track slick tread</p>
                                            </td>
                                        </tr>
                                        <tr class="seat-back-height">
                                            <th>Seat back height</th>
                                            <td>
                                                <p>21.5″</p>
                                            </td>
                                        </tr>
                                        <tr class="head-room-inside-canopy">
                                            <th>Head room (inside canopy)</th>
                                            <td>
                                                <p>25″</p>
                                            </td>
                                        </tr>
                                        <tr class="pa_color">
                                            <th>Color</th>
                                            <td>
                                                <p>Black, Blue, Red, White</p>
                                            </td>
                                        </tr>
                                        <tr class="pa_size">
                                            <th>Size</th>
                                            <td>
                                                <p>M, S</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> --}}
                            <div class="tab-pane fade" id="Vendor-info">
                                <div class="vendor-logo d-flex mb-30">
                                    <img src="{{ !empty($product->vendor->photo) ? url('upload/vendor_images/' . $product->vendor->photo) : url('upload/no_image.jpg') }}"
                                        alt="" />
                                    <div class="vendor-name ml-15">

                                        @if ($product->vendor_id == null)
                                            <h6>
                                                <a href="#">Owner.</a>
                                            </h6>
                                        @else
                                            <h4 class="mb-1">
                                                <a href="#"
                                                    class="text-danger">{{ ucwords($product->vendor->name) }}.</a>
                                            </h4>
                                        @endif
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                        </div>
                                    </div>
                                </div>
                                @if ($product->vendor_id == null)
                                    <ul class="contact-infor mb-20">
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}"
                                                alt="" /><strong>Address: </strong> <span></span></li>
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}"
                                                alt="" /><strong>Vendor PhoneNo: </strong><span></span></li>
                                    </ul>
                                @else
                                    <ul class="contact-infor mb-20">
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}"
                                                alt="" /><strong>Address: </strong>
                                            <span>{{ $product['vendor']['address'] }}</span>
                                        </li>
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}"
                                                alt="" /><strong>Vendor PhoneNo: </strong><span>(+977)
                                                {{ $product['vendor']['phone'] }}</span></li>
                                    </ul>
                                @endif
                                @if ($product->vendor_id == null)
                                    <p>Owner Information</p>
                                @else
                                    <p style="text-align: justify">{{ $product['vendor']['vendor_short_info'] }}.</p>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="Reviews">
                                <!--Comments-->
                                <div class="comments-area">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="mb-30">Customer Ratings and Reviews</h4>
                                            <div class="comment-list">

                                                @php
                                                    $reviews = App\Models\Review::where('product_id', $product->id)
                                                        ->latest()
                                                        ->limit(5)
                                                        ->get();

                                                    $totalReviews = App\Models\Review::where('product_id', $product->id)
                                                        ->latest()
                                                        ->get();
                                                    $currentProductReviewCount = $totalReviews->count();
                                                @endphp

                                                @if ($currentProductReviewCount == 0)
                                                    <p class="text-danger"><strong>No Reviews for this Product
                                                            Yet.</strong></p>
                                                @else
                                                    @foreach ($reviews as $item)
                                                        @if ($item->status == 0)
                                                            <p class="text-danger"><strong>No Reviews yet.</strong></p>
                                                        @elseif($item->status == 1)
                                                            <div
                                                                class="single-comment justify-content-between d-flex mb-30">
                                                                <div class="user justify-content-between d-flex">
                                                                    <div class="thumb text-center">
                                                                        <img id="showImage"
                                                                            src="{{ !empty($item->user->photo) ? url('upload/user_images/' . $item->user->photo) : url('upload/no_image.jpg') }}"
                                                                            alt="image" width="60">
                                                                        <br>
                                                                        <a
                                                                            href="{{ route('dashboard') }}"class="font-heading text-brand">{{ $item->user->name }}</a>
                                                                    </div>
                                                                    <div class="desc">
                                                                        <div
                                                                            class="d-flex justify-content-between mb-10">
                                                                            <div class="d-flex align-items-center">
                                                                                <span
                                                                                    class="font-xs text-muted">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                                                            </div>

                                                                            <div class="product-rate d-inline-block">
                                                                                @if ($item->rating != null)
                                                                                    <div class="product-rating"
                                                                                        style="width: {{ $item->rating * 20 }}%">
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <p class="mb-10">{{ $item->comment }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>

                                        @php
                                            $reviewCount = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->latest()
                                                ->get();
                                            $average = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->avg('rating');
                                        @endphp

                                        <div class="col-lg-4">
                                            <h4 class="mb-30">Customer reviews</h4>
                                            <div class="d-flex mb-30">
                                                <div class="product-rate d-inline-block mr-15">
                                                    <div class="product-rating"
                                                        style="width: {{ round($average * 20) }}%"></div>
                                                </div>
                                                <h6>{{ number_format($average, 1) }} out of 5</h6>
                                            </div>
                                            @foreach ([5, 4, 3, 2, 1] as $star)
                                                <div class="progress mb-4">
                                                    <span>{{ $star }} star</span>

                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $reviewCount->count() > 0 ? round(($reviewCount->where('rating', $star)->count() / $reviewCount->count()) * 100) : 0 }}%"
                                                        aria-valuenow="{{ $reviewCount->count() > 0 ? round(($reviewCount->where('rating', $star)->count() / $reviewCount->count()) * 100) : 0 }}"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        {{ $reviewCount->count() > 0 ? round(($reviewCount->where('rating', $star)->count() / $reviewCount->count()) * 100) : 0 }}%
                                                    </div>


                                                </div>
                                            @endforeach
                                            <h5 class="font-xs text-secondary">{{ count($reviewCount) }} Customer
                                                Reviews</h5>
                                        </div>

                                    </div>
                                </div>

                                <!--comment form-->
                                <div class="comment-form">
                                    <h4 class="mb-15">Add a review</h4>
                                    @guest
                                        <p><strong class="text-danger">You need to login before adding product review. <a
                                                    href="{{ route('login') }}">Login Here</a></strong></p>
                                    @else
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <form class="form-contact comment_form"
                                                    action="{{ route('store.review') }}" method="POST"
                                                    id="commentForm">
                                                    @csrf
                                                    <div class="row">
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">

                                                        @if ($product->vendor_id == null)
                                                            <input type="hidden" name="hvendor_id" value="">
                                                        @else
                                                            <input type="hidden" name="hvendor_id"
                                                                value="{{ $product->vendor_id }}">
                                                        @endif

                                                        <table class="table" style="width: 50%">
                                                            <thead>
                                                                <tr>
                                                                    <th class="cell-level">&nbsp;</th>
                                                                    <th>1 star</th>
                                                                    <th>2 star</th>
                                                                    <th>3 star</th>
                                                                    <th>4 star</th>
                                                                    <th>5 star</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    
                                                                    <td class="cell-level"><strong>Quality</strong></td>
                                                                    <td>
                                                                        <label class="rating rate-1">
                                                                            <input required="" type="radio"
                                                                            name="quality" class="d-none radio-sm"
                                                                            value="1">
                                                                            <i class="fa-solid fa-star"></i>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <label class="rating rate-2">
                                                                            <input required="" type="radio"
                                                                            name="quality" class="d-none radio-sm"
                                                                            value="2">
                                                                            <i class="fa-solid fa-star"></i>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <label class="rating rate-3">
                                                                            <input required="" type="radio"
                                                                            name="quality" class="d-none radio-sm"
                                                                            value="3">
                                                                            <i class="fa-solid fa-star"></i>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <label class="rating rate-4">
                                                                            <input required="" type="radio"
                                                                            name="quality" class="d-none radio-sm"
                                                                            value="4">
                                                                            <i class="fa-solid fa-star"></i>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <label class="rating rate-5">
                                                                            <input required="" type="radio"
                                                                            name="quality" class="d-none radio-sm"
                                                                            value="5">
                                                                            <i class="fa-solid fa-star"></i>
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea required="" class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                                                    placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="button button-contactForm">Submit
                                                            Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-60">
                    <div class="col-12">
                        <h2 class="section-title style-1 mb-30">Related products</h2>
                    </div>
                    <div class="col-12">
                        <div class="row related-products">

                            @forelse ($relatedProduct as $product)
                                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                        data-wow-delay=".1s">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a
                                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                                    <img class="default-img"
                                                        src = "{{ asset($product->product_thumbnail) }}"
                                                        alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Add To Wishlist" class="action-btn" href=""><i
                                                        class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn" href=""><i
                                                        class="fi-rs-shuffle"></i></a>
                                                <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                                    data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                            </div>

                                            @php
                                                $amount = $product->selling_price - $product->discount_price;
                                                $discount = ($product->discount_price / $product->selling_price) * 100;
                                            @endphp

                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                @if ($product->discount_price == null)
                                                    <span class="new">New</span>
                                                @else
                                                    <span class="hot">{{ round($discount) }} %</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="">{{ $product['category']['category_name'] }}</a>
                                            </div>
                                            <h2><a
                                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                            </h2>
                                            <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                                            </div>
                                            <div>
                                                @if ($product->vendor_id == null)
                                                    <span class="font-small text-muted">By <a
                                                            href="">Admin</a></span>
                                                @else
                                                    <span class="font-small text-muted">By <a
                                                            href="">{{ $product['vendor']['name'] }}</a></span>
                                                @endif
                                            </div>
                                            <div class="product-card-bottom">
                                                @if ($product->discount_price == null)
                                                    <div class="product-price">
                                                        <span>Rs.
                                                            {{ $product->selling_price % 1 === 0 ? number_format($product->selling_price) : number_format($product->selling_price, 2, '.', '') }}</span>
                                                    </div>
                                                @else
                                                    <div class="product-price">
                                                        @php
                                                            $discountedPrice = $product->selling_price - $product->discount_price;
                                                        @endphp
                                                        <span>Rs.
                                                            {{ $discountedPrice % 1 === 0 ? number_format($discountedPrice) : number_format($discountedPrice, 2, '.', '') }}</span>
                                                        <span class="old-price">Rs.
                                                            {{ $product->selling_price % 1 === 0 ? number_format($product->selling_price) : number_format($product->selling_price, 2, '.', '') }}</span>
                                                    </div>
                                                @endif


                                                <div class="add-cart">
                                                    <a class="add"
                                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><i
                                                            class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end product card-->
                            @empty
                                <h5 class="text-danger">No Product Found</h5>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
