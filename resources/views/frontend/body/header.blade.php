<header class="header-area header-style-1 header-height-2">
@php
    $userData = null;
    if (Auth::check()) {
        $id = Auth::user()->id; 
        $userData = App\Models\User::find($id); 
    }
@endphp





    <div class="mobile-promotion">
        <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
    </div>
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>

                            <li><a href="{{ route('myCart') }}">My Cart</a></li>
                            <li><a href="{{ route('checkout') }}">Checkout</a></li>
                            <li><a href="{{ route('user.track.order') }}">Order Tracking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        {{-- <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>100% Secure delivery without contacting the courier</li>
                                <li>Supper Value Deals - Save more with coupons</li>
                                <li>Trendy 25silver jewelry, save up 35% off today</li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>

                            <li>
                                <a class="language-dropdown-active" href="#">English <i
                                        class="fi-rs-angle-small-down"></i></a>
                                <ul class="language-dropdown">
                                    <li>
                                        <a href="#"><img
                                                src = "{{ asset('frontend/assets/imgs/theme/flag-fr.png') }} "
                                                alt="" />Français</a>
                                    </li>
                                    <li>
                                        <a href="#"><img
                                                src = "{{ asset('frontend/assets/imgs/theme/flag-dt.png') }} "
                                                alt="" />Deutsch</a>
                                    </li>
                                    <li>
                                        <a href="#"><img
                                                src = "{{ asset('frontend/assets/imgs/theme/flag-ru.png') }} "
                                                alt="" />Pусский</a>
                                    </li>
                                </ul>
                            </li>

                            <li>Need help? Call Us: <strong class="text-brand"> +977 9862394599</strong></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    @php 
                        $setting = App\Models\SiteSetting::find(1);
                    @endphp
                    {{-- <a href="/"><img src = "{{ asset('frontend/assets/imgs/theme/logo.svg') }}" alt="logo" /></a> --}}
                    <a href="/"><img src = "{{ asset($setting->logo) }}" alt="logo" /></a>
                </div>
                <div class="header-right">

                    <div class="search-style-2">
                        {{-- STYLING SEARCH FILTER --}}
                        <style>
                            #searchProducts{
                                position: absolute;
                                top: 100%;
                                left: 0;
                                width: 100%;
                                background: #ffffff;
                                z-index: 999;
                                border-radius: 8px;
                                margin-top: 5px;
                            }
                        </style>
                        {{-- SCRIPT FOR FOCUSING AND BLUR --}}
                        <script>
                            function search_result_show(){
                                $("#searchProducts").slideDown();
                            }
                            function search_result_hide(){
                                $("#searchProducts").slideUp();
                            }
                        </script>

@php
    $categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
@endphp

                        <form action="{{ route('search.product') }}" method="POST">
                            @csrf
                            <select class="select-active">
                                <option>All Categories</option>
                                @foreach ($categories as $item)
                                    <option><a href="{{ url('product/category/'.$item->id.'/'.$item->category_slug) }}">{{ $item->category_name }}</a></option>
                                @endforeach
                            </select>
                            <input autocomplete="off" onfocus="search_result_show()" onblur="search_result_hide()" name="search" id="search" placeholder="Search for items..." />

                            <div id="searchProducts">

                            </div>
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">

                            <div class="header-action-icon-2">
                                <a href="{{ route('wishlist') }}">
                                    <img class="svgInject" alt="Nest" src = "{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                    <span class="pro-count blue" id="wishQty">0</span>
                                </a>
                                <a href="{{ route('wishlist') }}"><span class="lable">Wishlist</span></a>
                            </div>

                            <div class="header-action-icon-2">
                                <a href="{{ route('compare') }}" style="display: inline-block;">
                                    {{-- <img class="svgInject" alt="Nest" src = "{{ asset('frontend/assets/imgs/theme/icons/icon-compare.svg') }}" /> --}}
                                   <i class="fi-rs-shuffle" style="font-size: 24px;"></i>
                                    <span class="pro-count blue" id="compareQty">0</span>
                                </a>
                                <a href="{{ route('compare') }}"><span class="lable">Compare</span></a>
                            </div>


                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('myCart') }}">
                                    <img alt="Nest"
                                        src = "{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                    <span class="pro-count blue" id="cartQty">0</span>
                                </a>
                                <a href="{{ route('myCart') }}"><span class="lable">Cart</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    {{-- // START MINI CART WITH AJAX --}}
                                    <div id="miniCart">

                                    </div>
                                    {{-- // END MINI CART WITH AJAX --}}

                                    <div class="">
                                        <div class="">
                                            <h4>Total:  <span>Rs.  <span id="cartSubTotal"> </span></span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('myCart') }}" class="outline">View cart </a> 
                                            <a href="{{ route('checkout') }}">| Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="header-action-icon-2 header-action-icon-apple">
                                <a href="{{ route('dashboard') }}" style="padding-right: 5px">
                                    <img id="showImage" src="{{ !empty($userData->photo) ? url('upload/'.$userData->role.'_images/'.$userData->photo) : asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" alt="User Image" class="rounded-circle">

                                </a>
                                @auth
                                    <a style="padding-top: 5px;" href="{{ route('dashboard') }}"><span class="lable ml-0">Account</span></a>
                                @else
                                    <a href="{{ route('login') }}"><span class="lable ml-0">Login </span></a>
                                    <span class="lable" style="margin-left: 3px; margin-right: 3px;"> | </span></a>
                                    <a href="{{ route('register') }}"><span class="lable ml-0">Register</span></a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@php
    $categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
@endphp



    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="/"><img src = "{{ asset('frontend/assets/imgs/theme/logo.svg') }}"
                            alt="logo" /></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categories-button-active" href="#">
                            <span class="fi-rs-apps"></span> All Categories
                            <i class="fi-rs-angle-down"></i>
                        </a>
                        <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                            <div class="d-flex categori-dropdown-inner">
                                <ul>
                                    @foreach ($categories as $item)
                                        @if($loop->index < 5)
                                        <a href="{{ url('product/category/'.$item->id.'/'.$item->category_slug) }}">
                                            <li>
                                            <a href="{{ url('product/category/'.$item->id.'/'.$item->category_slug) }}"> <img
                                                    src = "{{ asset($item->category_image) }}"
                                                    alt="" />{{ $item->category_name }}</a>
                                            </li>
                                        </a>
                                        @endif
                                    @endforeach
                                </ul>

                                 <ul class="end">                                   
                                    @foreach ($categories as $item)
                                        @if($loop->index > 4)
                                        <a href="{{ url('product/category/'.$item->id.'/'.$item->category_slug) }}">
                                            <li>
                                            <a href="{{ url('product/category/'.$item->id.'/'.$item->category_slug) }}"> <img
                                                    src = "{{ asset($item->category_image) }}"
                                                    alt="" />{{ $item->category_name }}</a>
                                            </li>
                                        </a>
                                        @endif
                                    @endforeach
                                </ul>
                                
                            </div>
                            {{-- <div class="more_slide_open" style="display: none">
                                <div class="d-flex categori-dropdown-inner">
                                    <ul>
                                        <li>
                                            <a href="#"> <img
                                                    src = "{{ asset('frontend/assets/imgs/theme/icons/icon-1.svg') }}"
                                                    alt="" />Milks and Dairies</a>
                                        </li>
                                    </ul>
                                    <ul class="end">
                                        <li>
                                            <a href="#"> <img
                                                    src = "{{ asset('frontend/assets/imgs/theme/icons/icon-3.svg') }}"
                                                    alt="" />Wines & Drinks</a>
                                        </li>
                                        <li>
                                            <a href="#"> <img
                                                    src = "{{ asset('frontend/assets/imgs/theme/icons/icon-4.svg') }}"
                                                    alt="" />Fresh Seafood</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        @php
                                            $showCategories = App\Models\Category::orderBy('category_name', 'DESC')->limit(2)->get();
                                        @endphp
                                        
                                        @foreach ($showCategories as $item)
                                            <a href="{{ url('product/category/'.$item->id.'/'.$item->category_slug) }}">
                                                <li>
                                                <a href="{{ url('product/category/'.$item->id.'/'.$item->category_slug) }}"> <img
                                                        src = "{{ asset($item->category_image) }}"
                                                        alt="" />{{ $item->category_name }}</a>
                                                </li>
                                            </a>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="more_categories"><span class="icon"></span> <span class="heading-sm-1">Show more...</span></div> --}}
                        </div>
                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                                </li>
                                @php
                                    $categories = App\Models\Category::orderBy('category_name', 'ASC')->limit(6)->get();
                                @endphp

                                @foreach ($categories as $category)
                                    <li>
                                        <a class="{{ request()->is('product/category/'.$category->id.'/'.$category->category_slug) ? 'active' : '' }}" href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}">{{ $category->category_name }} <i class="fi-rs-angle-down"></i></a>
                                        @php
                                            $subcategories = App\Models\Subcategory::where('category_id',$category->id)->orderBy('subcategory_name', 'ASC')->get();
                                        @endphp
                                                                    
                                        <ul class="sub-menu">
                                            @foreach ($subcategories as $subcategory)
                                                <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                                <li>
                                    <a class="{{ request()->routeIs('home.blog') ? 'active' : '' }}" href="{{ route('home.blog') }}">Blog</a>
                                </li>

                                <li>
                                    <a class="{{ request()->routeIs('shop.page') ? 'active' : '' }}" href="{{ route('shop.page') }}">Shop</a>
                                </li>
                            </ul>

                        </nav>
                    </div>
                </div>


                <div class="hotline d-none d-lg-flex">
                    <img src = "{{ asset('frontend/assets/imgs/theme/icons/icon-headphone.svg') }}" alt="hotline" />
                    <p>{{ $setting->support_phone }}<span class="mt-1">24/7 Support Center</span></p>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>

                {{-- <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="">
                                <img alt="heart"
                                    src = "{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                <span class="pro-count white">4</span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="#">
                                <img alt="Nest"
                                    src = "{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                <span class="pro-count white">2</span>
                            </a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                <ul>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="Nest"
                                                    src = "{{ asset('frontend/assets/imgs/shop/thumbnail-3.jpg') }}" /></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Plain Striola Shirts</a></h4>
                                            <h3><span>1 × </span>$800.00</h3>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="Nest"
                                                    src = "{{ asset('frontend/assets/imgs/shop/thumbnail-4.jpg') }}" /></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Macbook Pro 2022</a></h4>
                                            <h3><span>1 × </span>$3500.00</h3>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span>$383.00</span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="#">View cart</a>
                                        <a href="#">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</header>

<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="/"><img src = "{{ asset('frontend/assets/imgs/theme/logo.svg') }}"
                        alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="#">
                    <input type="text" placeholder="Search for items…" />
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">
                        <li class="menu-item-has-children">
                            <a href="/">Home</a>

                        </li>
                        <li class="menu-item-has-children">
                            <a href="{{ route('shop.page') }}">Shop</a>
                        </li>
                        
                        <li class="menu-item-has-children">
                            <a href="#">Categories</a>
                            <ul class="dropdown">
                                @foreach($categories as $category)
                                <li class="menu-item-has-children">
                                    <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}">{{ $category->category_name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="menu-item-has-children">
                            <a href="{{ route('home.blog') }}">Blog</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="">My Account</a></li>
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('login') }}">Register</a></li>
                                <li><a href="">Purchase Guide</a></li>
                                <li><a href="">Privacy Policy</a></li>
                                <li><a href="">Terms of Service</a></li>
                                <li><a href="">404 Page</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                <div class="single-mobile-header-info">
                    <a href=""><i class="fi-rs-marker"></i> Our location </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="{{ route('login') }}"><i class="fi-rs-user"></i>Log In  </a>
                    <a href="{{ route('register') }}"><i class="fi-rs-user"></i>Sign Up </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="#"><i class="fi-rs-headphones"></i>(+977) 9862394599 </a>
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Follow Us</h6>
                <a href="#"><img
                        src = "{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img src = "{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img
                        src = "{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img
                        src = "{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img src = "{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                        alt="" /></a>
            </div>
            <div class="site-copyright">Copyright 2022 © Nest. All rights reserved. Powered by AliThemes.</div>
        </div>
    </div>
</div>
