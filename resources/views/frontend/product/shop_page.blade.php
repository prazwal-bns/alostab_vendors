@extends('frontend.master_dashboard')
@section('main')

@section('title')
    Shop | Product
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<div class="page-header mt-30 mb-50">
    <div class="container">
        <div class="archive-header">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <div class="breadcrumb mb-2">
                        <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> Shop <span></span> Product
                    </div>
                    <h1 class="mb-15">Shop Product</h1>
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
            </div>
            {{-- <div class="shop-product-fillter">
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
            </div> --}}
            <div class="row product-grid">
                @foreach ($products as $product)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                        <img class="default-img" src = "{{ asset($product->product_thumbnail) }}"
                                            alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}"
                                        onClick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Compare" class="action-btn" id="{{ $product->id }}"
                                        onClick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                        onClick="productView(this.id)"><i class="fi-rs-eye"></i></a>
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
                                    <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                                </div>
                                <h2><a
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                </h2>
                                <div class="product-rate-cover">

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
                                <div>
                                    @if ($product->vendor_id == null)
                                        <span class="font-small text-muted">By <a
                                                href="vendor-details-1.html">Admin</a></span>
                                    @else
                                        <span class="font-small text-muted">By <a
                                                href="vendor-details-1.html">{{ $product['vendor']['name'] }}</a></span>
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
                                                class="fi-rs-shopping-cart mr-5"></i>Details </a>
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

            {{-- Filter By Price Start --}}
            <div class="sidebar-widget price_range range mb-30">
                <form method="post" action="{{ route('shop.filter') }}">
                    @csrf

                    <h5 class="section-title style-1 mb-30">Filter by price</h5>
                    <div class="price-filter">
                        <div class="price-filter-inner">

                            <div id="slider-range" class="price-filter-range" data-min="0" data-max="2000"></div>
                            <input type="hidden" id="price_range" name="price_range" value="">
                            <input type="text" id="amount" value="Rs.0 - Rs.2000" readonly="">

                            <br><br>

                            <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>
                                Filter</button>

                        </div>
                    </div>

                    <div class="list-group">
                        <div class="list-group-item mb-10 mt-10">
                            @if (!empty($_GET['category']))
                                @php
                                    $filterCat = explode(',', $_GET['category']);
                                @endphp
                            @endif

                            <label class="fw-900">Category</label>
                            @foreach ($categories as $category)
                                @php
                                    $products = App\Models\Product::where('category_id', $category->id)->get();
                                @endphp


                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="category[]"
                                        id="exampleCheckbox{{ $category->id }}"
                                        value="{{ $category->category_slug }}"
                                        @if (!empty($filterCat) && in_array($category->category_slug, $filterCat)) checked @endif
                                        onchange="this.form.submit()" />
                                    <label class="form-check-label"
                                        for="exampleCheckbox{{ $category->id }}"><span>{{ $category->category_name }}
                                            ({{ count($products) }})</span></label>
                                </div>
                            @endforeach



                            <label class="fw-900 mt-15">Brand</label>
                            @if (!empty($_GET['brand']))
                                @php
                                    $filterBrand = explode(',', $_GET['brand']);
                                @endphp
                            @endif

                            @foreach ($brands as $brand)
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="brand[]"
                                        id="exampleBrand{{ $brand->id }}" value="{{ $brand->brand_slug }}"
                                        @if (!empty($filterBrand) && in_array($brand->brand_slug, $filterBrand)) checked @endif
                                        onchange="this.form.submit()" />
                                    <label class="form-check-label"
                                        for="exampleBrand{{ $brand->id }}"><span>{{ $brand->brand_name }}
                                            ({{ count($products) }})</span></label>
                                </div>
                            @endforeach

                </form>

            </div>
        </div>
    </div>
    {{-- Filter By Price END --}}

    <!-- Product sidebar Widget -->
    <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
        <h5 class="section-title style-1 mb-30">New products</h5>

        @foreach ($newProduct as $product)
            <div class="single-post clearfix">
                <div class="image">
                    <img src="{{ asset($product->product_thumbnail) }}" alt="#" />
                </div>
                <div class="content pt-10">
                    <p><a
                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                    </p>
                    @if ($product->discount_price == null)
                        <p class="price mb-0 mt-5">Rs.
                            {{ $product->selling_price % 1 === 0 ? number_format($product->selling_price) : number_format($product->selling_price, 2, '.', '') }}
                        </p>
                    @else
                        <div class="product-price">
                            @php
                                $discountedPrice = $product->selling_price - $product->discount_price;
                            @endphp
                            <p class="price mb-0 mt-5">Rs.
                                {{ $discountedPrice % 1 === 0 ? number_format($discountedPrice) : number_format($discountedPrice, 2, '.', '') }}

                        </div>
                    @endif


                    @php
                        $reviewCount = App\Models\Review::where('product_id', $product->id)
                            ->where('status', 1)
                            ->latest()
                            ->get();
                        $average = App\Models\Review::where('product_id', $product->id)
                            ->where('status', 1)
                            ->avg('rating');
                    @endphp

                    <div class="product-rate mt-2">
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
                </div>
            </div>
        @endforeach
    </div>
</div>
</div>
</div>

<script type="text/javascript">
    
    $(document).ready(function (){
        if ($('#slider-range').length > 0) {
            const max_price = parseInt($('#slider-range').data('max'));
            const min_price = parseInt($('#slider-range').data('min'));
            let price_range = min_price+"-"+max_price;

            let price = price_range.split('-');

                $("#slider-range").slider({
                    range: true, 
                    min: min_price,
                    max: max_price,
                    values: price,  
                slide: function (event, ui) { 

                $("#amount").val('Rs.'+ui.values[0]+"-"+'Rs.'+ui.values[1]);
                $("#price_range").val(ui.values[0]+"-"+ui.values[1]);
                }
                });  
        }
    })
</script>

@endsection
