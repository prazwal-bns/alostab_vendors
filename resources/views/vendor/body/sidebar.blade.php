
@php
    $id = Auth::user()->id;
    $vendorId = App\Models\User::find($id);
    $status = $vendorId->status;
@endphp

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src=" {{ asset('adminbackend/assets/images/prev-logo-icon.png') }}" height="25" alt="logo icon">
            {{-- <img src=" {{ asset('adminbackend/assets/images/logo-icon.png') }}" height="30" alt="logo icon"> --}}
        </div>
        <div>
            <h4 class="logo-text"><a href="{{ route('vendor.dashboard') }}">Vendor</a></h4>
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

        @if($status === 'active')
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Manage Product</div>
            </a>
            <ul>
                <li> <a href="{{ route('vendor.add.product') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
                <li> <a href="{{ route('vendor.all.product') }}"><i class="bx bx-right-arrow-alt"></i>All Products</a>
                </li>
              
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">All Orders</div>
            </a>
            <ul>
                <li> <a href="{{ route('vendor.order') }}"><i class="bx bx-right-arrow-alt"></i>Vendor Order</a>
                </li>
                <li> <a href="{{ route('vendor.return.order') }}"><i class="bx bx-right-arrow-alt"></i>Return Orders</a>
                    
                <li> <a href="{{ route('vendor.complete.return.order') }}"><i class="bx bx-right-arrow-alt"></i>Completed Return Order</a>
                </li>
            </ul>
        </li>

         <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-cart"></i>
                </div>
                <div class="menu-title">Manage Reviews</div>
            </a>
            <ul>
                <li> <a href="{{ route('vendor.all.review') }}"><i class="bx bx-right-arrow-alt"></i>Pending Reviews</a></li>
                {{-- <li> <a href="{{ route('published.review') }}"><i class="bx bx-right-arrow-alt"></i>Published Review</a></li> --}}
            </ul>
        </li>

        @else

        @endif

        
        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
