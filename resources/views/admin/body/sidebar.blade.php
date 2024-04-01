<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src=" {{ asset('adminbackend/assets/images/prev-logo-icon.png') }}" height="25" alt="logo icon">
            {{-- <img src=" {{ asset('adminbackend/assets/images/prev-logo-icon.png') }}" class="logo-icon" alt="logo icon"> --}}
        </div>
        <div>
            <h4 class="logo-text"><a href="{{ route('admin.dashboard') }}">Admin</a></h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        @if(Auth::user()->canAll('brand.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>
                    @if(Auth::user()->canAll('brand.list'))
                        <li> <a href="{{route('all.brand')}}"><i class="bx bx-right-arrow-alt"></i>All Brands</a>
                        </li>
                    @endif 

                    @if(Auth::user()->canAll('brand.add'))
                        <li> <a href="{{route('add.brand')}}"><i class="bx bx-right-arrow-alt"></i>Add Brand</a>
                        </li>
                    @endif
            </ul>
        </li>
        @endif

        @if(Auth::user()->canAll('cat.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
                @if(Auth::user()->canAll('category.list'))
                <li> <a href="{{route('all.category')}}"><i class="bx bx-right-arrow-alt"></i>All Category</a>
                </li>
                @endif

                @if(Auth::user()->canAll('category.add'))
                <li> <a href="{{route('add.category')}}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
                </li>
                @endif
                
            </ul>
        </li>
        @endif
        

        @if(Auth::user()->canAll('subcategory.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Sub Category</div>
            </a>
            <ul>
                @if(Auth::user()->canAll('subcategory.list'))
                <li> <a href="{{route('all.subcategory')}}"><i class="bx bx-right-arrow-alt"></i>All Sub-Category</a>
                </li>
                @endif

                @if(Auth::user()->canAll('subcategory.add'))
                <li> <a href="{{route('add.subcategory')}}"><i class="bx bx-right-arrow-alt"></i>Add Sub-Category</a>
                </li>
                @endif
                
            </ul>
        </li>
        @endif


        @if(Auth::user()->canAll('product.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Product</div>
            </a>
            <ul>
                @if(Auth::user()->canAll('product.list'))
                <li> <a href="{{route('all.product')}}"><i class="bx bx-right-arrow-alt"></i>All Products</a>
                </li>
                @endif

                @if(Auth::user()->canAll('product.add'))
                <li> <a href="{{route('add.product')}}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
                @endif
                
            </ul>
        </li>
        @endif


        @if(Auth::user()->canAll('slider.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Slider</div>
            </a>
            <ul>
                @if(Auth::user()->canAll('slider.list'))
                <li> <a href="{{route('all.slider')}}"><i class="bx bx-right-arrow-alt"></i>All Slider</a>
                </li>
                @endif

                @if(Auth::user()->canAll('slider.add'))
                <li> <a href="{{route('add.slider')}}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
                </li>
                @endif
                
            </ul>
        </li>
        @endif

        @if(Auth::user()->canAll('ads.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Manage Banner</div>
            </a>
            <ul>
                @if(Auth::user()->canAll('ads.list'))
                <li> <a href="{{route('all.banner')}}"><i class="bx bx-right-arrow-alt"></i>All Banner</a>
                </li>
                @endif

                @if(Auth::user()->canAll('ads.add'))
                <li> <a href="{{route('add.banner')}}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
                </li>
                @endif
            </ul>
        </li>
        @endif


        @if(Auth::user()->canAll('coupoun.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Coupoun System</div>
            </a>
            <ul>
                @if(Auth::user()->canAll('coupoun.list'))
                <li> <a href="{{route('all.coupoun')}}"><i class="bx bx-right-arrow-alt"></i>All Coupoun</a>
                </li>
                @endif


                @if(Auth::user()->canAll('coupoun.add'))
                <li> <a href="{{route('add.coupoun')}}"><i class="bx bx-right-arrow-alt"></i>Add Coupoun</a>
                </li>
                @endif
                
            </ul>
        </li>
        @endif


        @if(Auth::user()->canAll('area.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Shipping Area</div>
            </a>
            <ul>
                <li> <a href="{{route('all.district')}}"><i class="bx bx-right-arrow-alt"></i>All District</a>
                </li>
                <li> <a href="{{route('all.city')}}"><i class="bx bx-right-arrow-alt"></i>All City</a>
                </li>
                <li> <a href="{{route('all.state')}}"><i class="bx bx-right-arrow-alt"></i>All State</a>
                </li>
                
            </ul>
        </li>
        @endif

        
        @if(Auth::user()->canAll('vendor.menu'))
        <li class="menu-label">Order and Vendors</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Manage Vendor</div>
            </a>
            <ul>
                <li> <a href="{{route('inactive.vendor')}}"><i class="bx bx-right-arrow-alt"></i>Inactive Vendor</a>
                </li>
                <li> <a href="{{route('active.vendor')}}"><i class="bx bx-right-arrow-alt"></i>Active Vendor</a>
                </li>
            </ul>
        </li>
        @endif


        @if(Auth::user()->canAll('order.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Manage Order</div>
            </a>
            <ul>
                <li> <a href="{{route('pending.order')}}"><i class="bx bx-right-arrow-alt"></i>Pending Orders</a></li>
                <li> <a href="{{route('admin.confirmed.order')}}"><i class="bx bx-right-arrow-alt"></i>Confirmed Orders</a></li>
                <li> <a href="{{route('admin.processing.order')}}"><i class="bx bx-right-arrow-alt"></i>Processing Orders</a></li>
                <li> <a href="{{route('admin.delivered.order')}}"><i class="bx bx-right-arrow-alt"></i>Delivered Orders</a></li>
            </ul>
        </li>
        @endif


        @if(Auth::user()->canAll('return.order.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-cart"></i>
                </div>
                <div class="menu-title">Return Order</div>
            </a>
            <ul>
                <li> <a href="{{route('return.request')}}"><i class="bx bx-right-arrow-alt"></i>Requested Order Return</a></li>
                <li> <a href="{{route('completed.request')}}"><i class="bx bx-right-arrow-alt"></i>Completed Order Return</a></li>
            </ul>
        </li>
        @endif

        @if(Auth::user()->canAll('user.management.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-cart"></i>
                </div>
                <div class="menu-title">Manage User</div>
            </a>
            <ul>
                <li> <a href="{{route('all.user')}}"><i class="bx bx-right-arrow-alt"></i>All Customers</a></li>
                <li> <a href="{{route('all.vendor')}}"><i class="bx bx-right-arrow-alt"></i>All Vendors</a></li>
            </ul>
        </li>
        @endif


        @if(Auth::user()->canAll('report.menu'))
        <li class="menu-label">Report Generation</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-line-chart"></i>
                </div>
                <div class="menu-title">Manage Report</div>
            </a>
            <ul>
                <li> <a href="{{ route('view.report') }}"><i class="bx bx-right-arrow-alt"></i>View Report</a></li>
                <li> <a href="{{ route('order.by.user') }}"><i class="bx bx-right-arrow-alt"></i>Order By User</a></li>
            </ul>
        </li>
        @endif


        @if(Auth::user()->canAll('blog.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Manage Blogs</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.blog.category') }}"><i class="bx bx-right-arrow-alt"></i>All Blog Categories</a></li>
                <li> <a href="{{ route('all.blog.posts') }}"><i class="bx bx-right-arrow-alt"></i>All Blog Posts</a></li>
            </ul>
        </li>
        <li>
        @endif

        @if(Auth::user()->canAll('review.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-cart"></i>
                </div>
                <div class="menu-title">Manage Reviews</div>
            </a>
            <ul>
                <li> <a href="{{ route('pending.review') }}"><i class="bx bx-right-arrow-alt"></i>Pending Reviews</a></li>
                <li> <a href="{{ route('published.review') }}"><i class="bx bx-right-arrow-alt"></i>Published Review</a></li>
            </ul>
        </li>
        @endif


        @if(Auth::user()->canAll('site.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Manage Site Settings</div>
            </a>
            <ul>
                <li> <a href="{{ route('site.setting') }}"><i class="bx bx-right-arrow-alt"></i>Site Setting</a></li>
                <li> <a href="{{ route('seo.setting') }}"><i class="bx bx-right-arrow-alt"></i>SEO Setting</a></li>
            </ul>
        </li>
        @endif


        @if(Auth::user()->canAll('stock.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-cart"></i>
                </div>
                <div class="menu-title">Manage Stock</div>
            </a>
            <ul>
                <li> <a href="{{ route('product.stock') }}"><i class="bx bx-right-arrow-alt"></i>Product Stock</a></li>
            </ul>
        </li>
        @endif

        <li>

        @if(Auth::user()->canAll('role.permission.menu'))
        <li class="menu-label">Roles & Permissions</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-line-chart"></i>
                </div>
                <div class="menu-title">Role & Permission</div>
            </a>
            <ul>
                {{-- <li> <a href="{{ route('all.permission') }}"><i class="bx bx-right-arrow-alt"></i>All Permission</a></li> --}}
                <li> <a href="{{route('all.roles')}}"><i class="bx bx-right-arrow-alt"></i>All Roles</a></li>

                <li> <a href="{{route('add.roles.permission')}}"><i class="bx bx-right-arrow-alt"></i>Add Roles & Permission</a></li>

                <li> <a href="{{route('all.roles.permission')}}"><i class="bx bx-right-arrow-alt"></i>All Roles & Permission</a></li>
            </ul>
        </li>
        @endif


        @if(Auth::user()->canAll('admin.user.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-bookmark-heart"></i>
                </div>
                <div class="menu-title">Manage Admin</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.admin') }}"><i class="bx bx-right-arrow-alt"></i>All Admin</a></li>
                <li> <a href="{{route('add.admin')}}"><i class="bx bx-right-arrow-alt"></i>Add Admin</a></li>
            </ul>
        </li>
        @endif
    </ul>
    <!--end navigation-->
</div>
