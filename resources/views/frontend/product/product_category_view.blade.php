@extends('frontend.master_dashboard')
@section('main')
<div class="page-header mt-30 mb-50">
    <div class="container">
        <div class="archive-header">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <div class="breadcrumb mb-2">
                        <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> Shop <span></span> {{ $breadCrumb->category_name }}
                    </div>
                    <h1 class="mb-15">{{ $breadCrumb->category_name }}</h1>
                </div>
                
            </div>
        </div>
    </div>
</div>

</div>

<div class="container mb-30">
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand">{{ count($products) }}</strong> items for you!</p>
                </div>
                <div class="sort-by-product-area">
                    <div class="sort-by-cover mr-10">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps"></i>Show:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">50</a></li>
                                <li><a href="#">100</a></li>
                                <li><a href="#">150</a></li>
                                <li><a href="#">200</a></li>
                                <li><a href="#">All</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sort-by-cover">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">Featured</a></li>
                                <li><a href="#">Price: Low to High</a></li>
                                <li><a href="#">Price: High to Low</a></li>
                                <li><a href="#">Release Date</a></li>
                                <li><a href="#">Avg. Rating</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row product-grid">
                @foreach($products as $product)
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                            data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                        <img class="default-img"
                                            src = "{{ asset($product->product_thumbnail) }}"
                                            alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onClick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onClick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onClick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                </div>
                            
                            @php
                                $amount =$product->selling_price - $product->discount_price;
                                $discount = ($product->discount_price / $product->selling_price) * 100;
                            @endphp

                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if ($product->discount_price == NULL)
                                        <span class="new">New</span>
                                    @else    
                                        <span class="hot">{{ round($discount) }} %</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                                </div>
                                <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a></h2>
                                <div class="product-rate-cover">
                                    
                                    @php
                                    $reviewCount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                    $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                    @endphp

                                    <div class="product-rate d-inline-block">
                                        @if($average == 0)
                                        
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
                                <div>
                                    @if ($product->vendor_id == NULL)
                                    <span class="font-small text-muted">By <a
                                            href="vendor-details-1.html">Admin</a></span>
                                    @else
                                    <span class="font-small text-muted">By <a
                                        href="vendor-details-1.html">{{ $product['vendor']['name'] }}</a></span>
                                    @endif
                                </div>
                                <div class="product-card-bottom">
                                    @if ($product->discount_price == NULL)
                                        <div class="product-price">
                                            <span>Rs. {{ $product->selling_price % 1 === 0 ? number_format($product->selling_price) : number_format($product->selling_price, 2, '.', '') }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            @php
                                                $discountedPrice = $product->selling_price - $product->discount_price;
                                            @endphp
                                            <span>Rs. {{ $discountedPrice % 1 === 0 ? number_format($discountedPrice) : number_format($discountedPrice, 2, '.', '') }}</span>
                                            <span class="old-price">Rs. {{ $product->selling_price % 1 === 0 ? number_format($product->selling_price) : number_format($product->selling_price, 2, '.', '') }}</span>
                                        </div>
                                    @endif

                                    
                                    <div class="add-cart">
                                        <a class="add" href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"><i class="fi-rs-shopping-cart mr-5"></i>Details </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!--product grid-->
            <div class="pagination-area mt-20 mb-20">
                <nav aria-label="Page navigation example">
                    {{-- <ul class="pagination justify-content-start">
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                        </li>
                    </ul> --}}
                </nav>
            </div>
            
            <!--End Deals-->

            
        </div>
        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            <div class="sidebar-widget widget-category-2 mb-30">
                <h5 class="section-title style-1 mb-30">Category</h5>
                <ul>
                    @foreach($categories as $category)
                    @php
                        $products = App\Models\Product::where('category_id',$category->id)->get();   
                    @endphp

                    <li>
                        <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}"> <img src="{{ asset($category->category_image) }}" alt="" />{{ $category->category_name }}</a><span class="count">{{ count($products) }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            
            <!-- Product sidebar Widget -->
            <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                <h5 class="section-title style-1 mb-30">New products</h5>

                @foreach ($newProduct as $product)
                <div class="single-post clearfix">
                    <div class="image">
                        <img src="{{ asset($product->product_thumbnail) }}" alt="#" />
                    </div>
                    <div class="content pt-10">
                        <p><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a></p>
                        @if ($product->discount_price == NULL)
                            <p class="price mb-0 mt-5">Rs. {{ $product->selling_price % 1 === 0 ? number_format($product->selling_price) : number_format($product->selling_price, 2, '.', '') }} </p>
                        @else
                            <div class="product-price">
                                @php
                                    $discountedPrice = $product->selling_price - $product->discount_price;
                                @endphp
                                <p class="price mb-0 mt-5">Rs. {{ $discountedPrice % 1 === 0 ? number_format($discountedPrice) : number_format($discountedPrice, 2, '.', '') }}
                                
                            </div>
                        @endif
                    

                        @php
                        $reviewCount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                        $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                        @endphp

                        <div class="product-rate mt-2">
                            @if($average == 0)
                            
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
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection