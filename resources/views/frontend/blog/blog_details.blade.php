@extends('frontend.master_dashboard')
@section('main')

@section('title')
    {{ $blogDetails->post_title }} | Blog   
@endsection

@php 
    $comments = App\Models\BlogComment::where('blog_id', $blogDetails->id)->latest()->limit(5)->get();

    $totalComments = App\Models\BlogComment::where('blog_id', $blogDetails->id)->get();
    $commentCount = $totalComments->count();
@endphp
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> <a href="#">
                @foreach ($breadCat as $cat)
                    {{ $cat->blog_category_name }}
                @endforeach
            </a> <span>{{ $blogDetails->post_title }}</span>
        </div>
    </div>
</div>
<div class="page-content mb-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-11 col-lg-12 m-auto">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="single-page pt-50 pr-30">
                            <div class="single-header style-2">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-12 m-auto">
                                        <h2 class="mb-10">{{ $blogDetails->post_title }}</h2>
                                        <div class="single-header-meta">
                                            <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                                                <a class="author-avatar" href="#">
                                                    <img class="img-circle" src="{{ asset('frontend/assets/imgs/blog/icon-user.svg') }}"
                                                        alt="" />
                                                </a>
                                                <span class="post-by">By <a href="#">Admin</a></span>
                                                <span class="post-on has-dot">{{ Carbon\Carbon::parse($blogDetails->created_at)->diffForHumans() }}</span>
                                                <span class="time-reading has-dot">{{ $commentCount }} Comments</span>
                                            </div>
                                            <div class="social-icons single-share">
                                                {{-- <ul class="text-grey-5 d-inline-block">
                                                    <li class="mr-5">
                                                        <a href="#"><img
                                                                src="{{ asset('frontend/assets/imgs/theme/icons/icon-bookmark.svg') }}"
                                                                alt="" /></a>
                                                    </li>
                                                </ul> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <figure class="single-thumbnail">
                                <img src="{{ asset($blogDetails->post_image) }}" alt="blogimage"/>
                            </figure> --}}
                            <div class="single-content">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-12 m-auto">
                                        <img src="{{ asset($blogDetails->post_image) }}" width="500" height="420" alt="blogimage"/>
                                        <div style="text-align: justify;">
                                            <p>{!! $blogDetails->post_long_description !!}</p>
                                        </div>
                                        
                                        <!--Entry bottom-->
                                        <div class="entry-bottom mt-50 mb-30">
                                            <div class="social-icons single-share">
                                                <ul class="text-grey-5 d-inline-block">
                                                    <li><strong class="mr-10">Share this:</strong></li>
                                                    <li class="social-facebook">
                                                        <a href="https://www.facebook.com/"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook.svg') }}"alt="" /></a>
                                                    </li>
                                                    <li class="social-twitter">
                                                        <a href="https://www.twitter.com/"><img
                                                                src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter.svg') }}"
                                                                alt="" /></a>
                                                    </li>
                                                    <li class="social-instagram">
                                                        <a href="https://www.instagram.com/"><img
                                                                src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram.svg') }}"
                                                                alt="" /></a>
                                                    </li>
                                                    <li class="social-linkedin">
                                                        <a href="https://www.pinterest.com/"><img
                                                                src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest.svg') }}"
                                                                alt="" /></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!--Author box-->
                                            
                                        <h4 class="mb-5">Blog Comments ({{ $commentCount }})</h4>

                                        @if($commentCount == 0)
                                            <p class="text-danger">No comments yet in this Blog.</p>
                                        @else
                                            @foreach($comments as $item)
                                            <div class="author-bio p-30 mt-50 border-radius-15 bg-white">
                                                <div class="author-image mb-10">
                                                    <img id="showImage" src="{{ !empty($item->user->photo) ? url('upload/user_images/' . $item->user->photo) : url('upload/no_image.jpg') }}" width="60" alt="image">
                                                    <div class="author-infor">
                                                        <h5 class="mb-5">{{ $item->user->name }}</h5>
                                                        <p class="mb-0 text-muted font-xs">
                                                            <span class="has-dot">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="author-des">
                                                    <p>{{ $item->blog_comment }}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                        <!--Comment form-->
                                        <div class="comment-form">

                                            <h3 class="mb-15">Leave a Comment</h3>
                                            @guest
                                                <p><strong class="text-danger">You need to login before commenting in this blog. <a href="{{ route('login') }}">Login Here</a></strong></p>
                                            @else
                                            <div class="row">
                                                <div class="col-lg-9 col-md-12">

                                                    <form class="form-contact comment_form mb-50" method="POST" action="{{ route('store.blog.comment') }}" id="commentForm">
                                                        @csrf
                                                        <input type="hidden" name="blog_id" value="{{ $blogDetails->id }}">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <textarea class="form-control w-100" required="" name="blog_comment" id="comment" cols="30" rows="9"
                                                                        placeholder="Write Comment"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="button button-contactForm">Post Comment</button>
                                                        </div>
                                                    </form>

                                                    
                                                </div>
                                            </div>
                                            @endguest
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar pt-50">
                        <div class="widget-area">
                            {{-- <div class="sidebar-widget-2 widget_search mb-50">
                                <div class="search-form">
                                    <form action="#">
                                        <input type="text" placeholder="Search…" />
                                        <button type="submit"><i class="fi-rs-search"></i></button>
                                    </form>
                                </div>
                            </div> --}}
                            <div class="sidebar-widget widget-category-2 mb-50">
                                <h5 class="section-title style-1 mb-30">Category</h5>
                                <ul>
                                @foreach($blogCategories as $category)

                                @php
                                    $posts = App\Models\BlogPost::where('category_id',$category->id)->get();
                                @endphp
                                <li>
                                    <a href="{{ url('post/category/'.$category->id.'/'.$category->blog_category_slug) }}"> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-hot.svg') }}" alt="" />{{ $category->blog_category_name }}</a><span class="count">{{count($posts)}}</span>
                                </li>
                                @endforeach
                            </ul>
                            </div>

                            {{-- <div class="banner-img wow fadeIn mb-50 animated d-lg-block d-none">
                                <img src="assets/imgs/banner/banner-11.png" alt="" />
                                <div class="banner-text">
                                    <span>Oganic</span>
                                    <h4>
                                        Save 17% <br />
                                        on <span class="text-brand">Oganic</span><br />
                                        Juice
                                    </h4>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
