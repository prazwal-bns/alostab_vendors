@extends('frontend.master_dashboard')

@section('main')

@section('title')
    About | Page  
@endsection

@php 
    $setting = App\Models\SiteSetting::find(1);
@endphp

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> About <span></span> Page
        </div>
    </div>
</div>

<div class="container mb-20">
    <div class="row">
        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                <div class="vendor-logo mb-30">
                    <a href="/"><img src="{{ asset($setting->logo) }}" alt="logo" /></a>
                </div>
                <div class="vendor-info">
                    <div class="product-category">
                        <span class="text-secondary"><strong>Since: 2024</strong></span>
                    </div>
                    <h4 class="mb-5"><a href="#" class="text-heading">Alostab Vendors</a></h4>
                    <div class="product-rate-cover mb-15">
                        <div class="product-rate d-inline-block">
                            <div class="product-rating" style="width: 100%"></div>
                        </div>
                        <span class="font-small ml-5 text-muted">(5.0)</span>
                    </div>
                    <div class="vendor-des mb-30">
                        <p class="font-sm text-heading" style="text-align: justify">We offer a seamless shopping experience and empower entrepreneurs to showcase their offerings to a global audience. We also provide a seamless shopping experience by offering an intuitive and user-friendly platform that makes browsing, searching, and purchasing products effortless for customers. </p>
                    </div>
                    <div class="follow-social mb-20">
                        <h6 class="mb-15">Follow Us</h6>
                        <ul class="social-network">
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-tw.svg') }}" alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-fb.svg') }}" alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-insta.svg') }}" alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-pin.svg') }}" alt="" />
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="vendor-info">
                        <ul class="font-sm mb-20">
                            <li><img class="mr-5" src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Address:</strong> <span>Fulbari-11, Pokhara</span></li>
                            <li><img class="mr-5" src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Call Us:</strong><span>(+977) 9862394599</span></li>
                        </ul>
                        <a href="mailto:alostabvendors@gmail.com" class="btn btn-xs">Contact Us <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4-5">
            <div class="archive-header-2 text-center pt-20 pb-30">
                <h1 class="display-2 mb-50">Alostab Vendors</h1>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="vendor-info">
                        <div class="product-category">
                            <span class="text-secondary"><strong>Since: 2024</strong></span>
                        </div>
                        <h4 class="mb-5"><a href="#" class="text-heading">Alostab Vendors</a></h4>
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted">(4.0)</span>
                        </div>
                        <div class="vendor-des mb-30">
                            <p class="font-sm text-heading" style="text-align: justify">We provide a seamless shopping experience that empowers entrepreneurs to showcase their offerings to a global audience. Our platform is designed to be intuitive and user-friendly, making it easy for customers to browse, search, and purchase products with confidence. From personalized recommendations to seamless checkout processes, we ensure that every step of the shopping journey is smooth and enjoyable. </p>

                            <p class="font-sm text-heading" style="text-align: justify">For entrepreneurs, we offer a range of powerful tools and features to help them succeed. Sellers can create customizable storefronts that reflect their brand identity, upload high-quality images and videos to showcase their products, and leverage data analytics to make informed business decisions. Our platform also provides marketing and promotional tools to boost visibility and attract more customers, driving growth and success for businesses of all sizes. </p>

                           <p class="font-sm text-heading" style="text-align: justify">What sets us apart is our commitment to quality, innovation, and customer satisfaction. We prioritize user experience, security, and reliability, ensuring that both sellers and buyers have a positive and rewarding experience every time they use our platform. Our global reach allows entrepreneurs to tap into new markets and expand their customer base, while our dedicated support team is always available to assist with any questions or issues.</p>

                            <p class="font-sm text-heading" style="text-align: justify">At our core, we believe in the power of e-commerce to transform lives and businesses. By providing a seamless and empowering platform, we enable entrepreneurs to thrive in the digital marketplace and connect with a diverse and global audience. Join us today and experience the difference of Alostab Vendors.</p>
                        </div>
                        <div class="follow-social mb-20">
                            <h6 class="mb-15">Follow Us</h6>
                            <ul class="social-network">
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-tw.svg') }}" alt="" />
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-fb.svg') }}" alt="" />
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-insta.svg') }}" alt="" />
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-pin.svg') }}" alt="" />
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="vendor-info">
                            <ul class="font-sm mb-20">
                                <li><img class="mr-5" src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Address:</strong> <span>Fulbari-11, Pokhara</span></li>
                                <li><img class="mr-5" src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Call Us:</strong><span>(+977) 9862394599</span></li>
                            </ul>
                            <a href="mailto:alostabvendors@gmail.com" class="btn btn-xs">Contact Us <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
