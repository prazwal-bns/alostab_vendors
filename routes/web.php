<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ProvideController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReturnOrderController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\CoupounController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CheckOutController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('frontend/index');
// });

Route::get('/', [IndexController::class, 'Index']);

Route::get('/about', [IndexController::class, 'AboutPage'])->name('about.page');

// Frontend All Product Details Route
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

// vendor details
Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])->name('vendor.details');
Route::get('/vendor/all', [IndexController::class, 'VendorAll'])->name('vendor.all');

// Category Product - Nav
Route::get('/product/category/{id}/{slug}', [IndexController::class, 'ProductByCategory']);

// SUb Category Product - Nav
Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'ProductBySubCategory']);



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
});


// For Google Login => Socialite 
Route::get('/auth/{provider}/redirect', [ProvideController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProvideController::class, 'callback']);


// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
});



// Vendor Dashboard
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');

    Route::get('/vendor/mark-all-notifications-read', [VendorController::class, 'VendorMarkAllRead'])->name('vendor_mark_all_notifications_read');

    Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');


    Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');
    Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');

    // Vendor Add Product
    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/vendor/all/dashboard', 'VendorAllProduct')->name('vendor.all.product');
        Route::get('/vendor/add/dashboard', 'VendorAddProduct')->name('vendor.add.product');
        Route::get('vendor/subcategory/ajax/{category_id}', 'VendorGetSubCategory');

        Route::post('/vendor/store/product', 'VendorStoreProduct')->name('vendor.store.product');
        Route::get('/vendor/edit/product/{id}', 'VendorEditProduct')->name('vendor.edit.product');

        Route::post('/vendor/update/product/{id}', 'VendorUpdateProduct')->name('vendor.update.product');
        Route::post('/update/vendor/product/thumbnail/{id}', 'UpdateVendorProductThumbnail')->name('update.vendor.product.thumbnail');

        Route::post('/vendor/update/product/multiimage/{id}', 'VendorUpdateProductMultiimage')->name('vendor.update.product.multiimage');

        Route::get('vendor/delete/multiimg/product/{id}', 'VendorMultiImgDelete')->name('vendor.delete.multimg.product');

        Route::get('vendor/inactive/product/{id}', 'VendorInactiveProduct')->name('vendor.inactive.product');
        Route::get('vendor/active/product/{id}', 'VendorActiveProduct')->name('vendor.active.product');

        Route::get('vendor/delete/product/{id}', 'VendorDeleteProduct')->name('vendor.delete.product');
    });


    Route::controller(VendorOrderController::class)->group(function () {
        Route::get('/vendor/order', 'VendorOrder')->name('vendor.order');
        Route::get('/vendor/return/order', 'VendorReturnOrder')->name('vendor.return.order');
        Route::get('/vendor/complete/return/order', 'VendorCompleteReturnOrder')->name('vendor.complete.return.order');

        Route::get('/vendor/order/details/{order_id}', 'VendorOrderDetails')->name('vendor.order.details');
    });

    Route::controller(ReviewController::class)->group(function () {
        Route::get('/vendor/all/review', 'VendorAllReview')->name('vendor.all.review');
    });
});
// END MIDDLEWARE VENDOR


// Login Routes
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');



// Brand Controller
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(BrandController::class)->group(function () {
        Route::get('/all/brand', 'AllBrand')->name('all.brand');
        Route::get('/add/brand', 'AddBrand')->name('add.brand');
        Route::post('/store/brand', 'StoreBrand')->name('store.brand');

        // edit brand
        Route::get('/edit/brand/{id}', 'EditBrand')->name('edit.brand');
        // update brand
        Route::post('/update/brand/{id}', 'UpdateBrand')->name('update.brand');

        // delete brand
        Route::get('/delete/brand/{id}', 'DeleteBrand')->name('delete.brand');
    });
});


// Category Controller
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');

        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category/{id}', 'UpdateCategory')->name('update.category');

        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });
});


// Sub Category Controller
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/all/subcategory', 'AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory', 'AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory', 'StoreSubCategory')->name('store.subcategory');

        Route::get('/edit/subcategory/{id}', 'EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory/{id}', 'UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}', 'DeleteSubCategory')->name('delete.subcategory');


        Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Vendor Active and Inactive Route
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/inactive/vendor', 'InactiveVendor')->name('inactive.vendor');
        Route::get('/active/vendor', 'ActiveVendor')->name('active.vendor');
        Route::get('/inactive/vendor/details/{id}', 'InactiveVendorDetails')->name('inactive.vendor.details');
        Route::post('/active/vendor/approve', 'ActiveVendorApprove')->name('active.vendor.approve');

        Route::get('/active/vendor/details/{id}', 'ActiveVendorDetails')->name('active.vendor.details');
        Route::post('/inactive/vendor/approve', 'InactiveVendorApprove')->name('inactive.vendor.approve');
    });
});



// Admin Middleware, product, sliders banners
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Product Contrller
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');

        Route::post('/store/product', 'StoreProduct')->name('store.product');

        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');

        Route::post('/update/product/{id}', 'UpdateProduct')->name('update.product');
        Route::post('/update/product/thumbnail/{id}', 'UpdateProductThumbnail')->name('update.product.thumbnail');

        Route::post('/update/product/multiimage/{id}', 'UpdateProductMultiimage')->name('update.product.multiimage');

        Route::get('/delete/multiimg/product/{id}', 'DeleteMultiImgProduct')->name('delete.multimg.product');

        Route::get('/inactive/product/{id}', 'InactiveProduct')->name('inactive.product');
        Route::get('/active/product/{id}', 'ActiveProduct')->name('active.product');

        Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');

        // FOR PRODUCT STOCK
        Route::get('/product/stock', 'ProductStock')->name('product.stock');
    });

    // Slider Controller
    Route::controller(SliderController::class)->group(function () {
        Route::get('/all/slider', 'AllSlider')->name('all.slider');
        Route::get('/add/slider', 'AddSlider')->name('add.slider');
        Route::post('/store/slider', 'StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}', 'EditSlider')->name('edit.slider');
        Route::post('/update/slider/{id}', 'UpdateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}', 'DeleteSlider')->name('delete.slider');
    });

    // Banner Controller
    Route::controller(BannerController::class)->group(function () {
        Route::get('/all/banner', 'AllBanner')->name('all.banner');
        Route::get('/add/banner', 'AddBanner')->name('add.banner');
        Route::post('/store/banner', 'StoreBanner')->name('store.banner');
        Route::get('/edit/banner/{id}', 'EditBanner')->name('edit.banner');
        Route::post('/update/banner/{id}', 'UpdateBanner')->name('update.banner');

        Route::get('/delete/banner/{id}', 'DeleteBanner')->name('delete.banner');
    });

    // Coupoun Controller
    Route::controller(CoupounController::class)->group(function () {
        Route::get('/all/coupoun', 'AllCoupoun')->name('all.coupoun');
        Route::get('/add/coupoun', 'AddCoupoun')->name('add.coupoun');
        Route::post('/store/coupoun', 'StoreCoupoun')->name('store.coupoun');
        Route::get('/edit/coupoun/{id}', 'EditCoupoun')->name('edit.coupoun');
        Route::post('/update/coupoun/{id}', 'UpdateCoupoun')->name('update.coupoun');
        Route::get('/delete/coupoun/{id}', 'DeleteCoupoun')->name('delete.coupoun');
    });

    // Shipping Controller
    Route::controller(ShippingController::class)->group(function () {
        // SHIPPING DISTRICT
        Route::get('/all/district', 'AllDistrict')->name('all.district');

        Route::get('/add/district', 'AddDistrict')->name('add.district');
        Route::post('/store/district', 'StoreDistrict')->name('store.district');

        Route::get('/edit/district/{id}', 'EditDistrict')->name('edit.district');
        Route::post('/update/district/{id}', 'UpdateDistrict')->name('update.district');
        Route::get('/delete/district/{id}', 'DeleteDistrict')->name('delete.district');


        // SHIPPING CITY
        Route::get('/all/city', 'AllCity')->name('all.city');
        Route::get('/add/city', 'AddCity')->name('add.city');
        Route::post('/store/city', 'StoreCity')->name('store.city');
        Route::get('/edit/city/{id}', 'EditCity')->name('edit.city');
        Route::post('/update/city/{id}', 'UpdateCity')->name('update.city');
        Route::get('/delete/city/{id}', 'DeleteCity')->name('delete.city');

        // SHIPPING STATE
        Route::get('/all/state', 'AllState')->name('all.state');
        Route::get('/add/state', 'AddState')->name('add.state');
        Route::post('/store/state', 'StoreState')->name('store.state');
        Route::get('/city/ajax/{district_id}', 'GetCity');

        Route::get('/edit/state/{id}', 'EditState')->name('edit.state');
        Route::post('/update/state/{id}', 'UpdateState')->name('update.state');
        Route::get('/delete/state/{id}', 'DeleteState')->name('delete.state');
    });

    // MANAGE ORDER
    Route::controller(OrderController::class)->group(function () {
        // Pending Order
        Route::get('/pending/order', 'PendingOrder')->name('pending.order');
        Route::get('/admin/confirmed/order', 'AdminConfirmOrder')->name('admin.confirmed.order');
        Route::get('/admin/processing/order', 'AdminProcessingOrder')->name('admin.processing.order');
        Route::get('/admin/delivered/order', 'AdminDeliveredOrder')->name('admin.delivered.order');

        // CHANGE ORDER START
        Route::get('/pending/to/confirm/{id}', 'PendingToConfirm')->name('pendingTo.Confirm');
        Route::get('/confirm/to/processing/{id}', 'ConfirmToProcessing')->name('confirmTo.Processing');
        Route::get('/processing/to/delivered/{id}', 'ProcessingToDelivered')->name('processingTo.Delivered');

        // END CHANGE ORDER

        Route::get('/admin/invoice/download/{order_id}', 'AdminInvoiceDownload')->name('admin.invoice.download');
        Route::get('/admin/order/details/{order_id}', 'AdminOrderDetails')->name('admin.order.details');
    });


    // RETURN CONTROLLER
    Route::controller(ReturnOrderController::class)->group(function () {
        Route::get('/return/request', 'ReturnRequest')->name('return.request');
        Route::get('/approve/return/request/{order_id}', 'ApproveReturnRequest')->name('approve.return.request');

        Route::get('/completed/request', 'CompletedOrderRequest')->name('completed.request');
    });


    // REPORT GENERATION
    Route::controller(ReportController::class)->group(function () {
        Route::get('/view/report', 'ViewReport')->name('view.report');
        Route::post('/search/by/date', 'SearchByDate')->name('search-by-date');
        Route::post('/search/by/year/month', 'SearchByYearMonth')->name('search-by-year-month');
        Route::post('/search/by/year/only', 'SearchByYearOnly')->name('search-by-year-only');

        Route::get('/order/by/user', 'OrderByUser')->name('order.by.user');
        Route::post('/search/by/user', 'SearchByUser')->name('search-by-user');
    });


    // USER MANAGEMENT
    Route::controller(ActiveUserController::class)->group(function () {
        Route::get('/all/user', 'AllUser')->name('all.user');
        Route::get('/all/vendor', 'AllVendor')->name('all.vendor');
    });


    // BLOG CATEGORY AND BLOG POSTS
    Route::controller(BlogController::class)->group(function () {
        // START BLOG CATEGORY
        Route::get('/admin/all/blog/category', 'AllBlogCategory')->name('all.blog.category');
        Route::get('/admin/add/blog/category', 'AddBlogCategory')->name('add.blog.category');
        Route::post('/admin/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
        Route::get('/admin/edit/blog/category/{id}', 'EditBlogCategory')->name('edit.blog.category');
        Route::post('/admin/update/blog/category', 'UpdateBlogCategory')->name('update.blog.category');
        Route::get('/admin/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');
        // END BLOG CATEGORY


        // START BLOG POSTS
        Route::get('/admin/all/blog/posts', 'AllBlogPosts')->name('all.blog.posts');
        Route::get('/admin/add/blog/post', 'AddBlogPost')->name('add.blog.post');
        Route::post('/admin/store/blog/post', 'StoreBlogPost')->name('store.blog.post');
        Route::get('/admin/edit/blog/post/{id}', 'EditBlogPost')->name('edit.blog.post');
        Route::post('/admin/update/blog/post', 'UpdateBlogPost')->name('update.blog.post');
        Route::get('/admin/delete/blog/post/{id}', 'DeleteBlogPost')->name('delete.blog.post');

        // END BLOG CATEGORY
    });

    // RATINGS AND REVIEW BACKEND -> ADMIN VIEW
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/pending/review', 'PendingReview')->name('pending.review');
        Route::get('/approve/review/{id}', 'ApproveReview')->name('approve.review');

        Route::get('/published/review', 'PublishedReview')->name('published.review');

        Route::get('/delete/review/{id}', 'DeleteReview')->name('delete.review');
    });


    // SITE SETTINGS FOOTER LOGO BACKEND -> ADMIN VIEW
    Route::controller(SiteSettingController::class)->group(function () {
        Route::get('/site/setting', 'SiteSetting')->name('site.setting');
        Route::post('/site/setting/update', 'SiteSettingUpdate')->name('site.setting.update');

        Route::get('/seo/setting', 'SeoSetting')->name('seo.setting');
        Route::post('/seo/setting/update', 'SeoSettingUpdate')->name('seo.setting.update');
    });


    // USER ROLES AND PERMISSIONS
    Route::controller(RoleController::class)->group(function () {
        // FOR PERMISSION
        Route::get('/all/permission', 'AllPermission')->name('all.permission');
        Route::get('/add/permission', 'AddPermission')->name('add.permission');
        Route::post('/store/permission', 'StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');

        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');

        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');

        // ROLES
        Route::get('/all/roles', 'AllRoles')->name('all.roles');
        Route::get('/add/roles', 'AddRoles')->name('add.roles');
        Route::post('/store/roles', 'StoreRoles')->name('store.roles');
        Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
        Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
        Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');


        // ADD ROLES IN PERMISSION
        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/store/roles/permission', 'StoreRolePermission')->name('store.role.permission');
        Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');

        Route::get('/admin/edit/roles/{role_id}', 'AdminEditRoles')->name('admin.edit.roles');
        Route::post('/admin/update/roles/{role_id}', 'AdminUpdateRoles')->name('admin.update.roles');
        Route::get('/admin/delete/roles/{role_id}', 'AdminDeleteRoles')->name('admin.delete.roles');
    });

    // Manage Admin User -> Add, All admins
    Route::controller(AdminController::class)->group(function () {
        Route::get('/all/admin', 'AllAdmin')->name('all.admin');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin');
        Route::post('/admin/user/store', 'AdminUserStore')->name('admin.user.store');
        Route::get('/edit/admin/role/{id}', 'EditAdminRole')->name('edit.admin.role');

        Route::post('/admin/user/update/{id}', 'AdminUserUpdate')->name('admin.user.update');
        Route::get('/delete/admin/role/{id}', 'DeleteAdminRole')->name('delete.admin.role');
    });

    // Manage Admin User -> Add, All admins
    Route::controller(AdminController::class)->group(function () {
        Route::get('/mark-all-notifications-read', 'MarkAllRead')->name('mark_all_notifications_read');
    });
});
// end admin middleware


// BLOG FRONTEND -> VIEW
Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'AllBlog')->name('home.blog');
    Route::get('/post/details/{id}/{slug}', 'BlogDetails');
    Route::get('/post/category/{id}/{slug}', 'PostCategory');

    Route::post('/store/blog/comment', 'StoreBlogComment')->name('store.blog.comment');
});

// RATINGS AND REVIEW FRONTEND -> VIEW
Route::controller(ReviewController::class)->group(function () {
    Route::post('/store/review', 'StoreReview')->name('store.review');
});


// PRODUCT SEARCH ALL ROUTES
Route::controller(IndexController::class)->group(function () {
    Route::post('/search', 'SearchProduct')->name('search.product');

    // AJAX -> fa -> fashion
    Route::post('/search-product', 'AdvanceProductSearch');
});


// ALL PRODUCT SHOP
Route::controller(ShopController::class)->group(function () {
    Route::get('/shop', 'ShopPage')->name('shop.page');
    Route::post('/shop/filter', 'ShopFilter')->name('shop.filter');
});


// Product Quickview Modal With Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);



// Product ADD TO CART
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);


// Product MINI CART -> Displaying data in mini cart in navbar
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);

// PRODUCT REMOVE MINI CART
Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

// ADD TO CART FROM PRODUCT DETAILS PAGE
Route::post('/dcart/data/store/{id}', [CartController::class, 'AddToCartDetails']);

// Product ADD TO WISHLIST
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);


// Product ADD TO COMPARE
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);

// Apply Coupoun -> Frontend
Route::post('/apply-coupoun', [CartController::class, 'ApplyCoupoun']);

// Calculate and display coupoun amount
Route::get('/calculate-coupoun', [CartController::class, 'CalculateCoupoun']);

// REMOVE COUPOUN
Route::get('/remove-coupoun', [CartController::class, 'RemoveCoupoun']);


// Frontend->checkout
Route::get('/checkout', [CartController::class, 'StartCheckout'])->name('checkout');


// User All Route -> Middle ware for wishlist protection
Route::middleware(['auth', 'role:user'])->group(function () {
    // For Wishlist Page
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', 'AllWishlist')->name('wishlist');
        Route::get('/get-wishlist-product/', 'GetWishListProduct');
        Route::get('/get-product-reviews/{product_id}', 'GetProductReviews');


        Route::get('/wishlist-remove/{id}', 'WishlistRemove');
    });

    // For Compare Page
    Route::controller(CompareController::class)->group(function () {
        Route::get('/compare', 'AllCompare')->name('compare');
        Route::get('/get-compare-product/', 'GetCompareProduct');

        Route::get('/compare-remove/{id}', 'CompareRemove');
    });

    // For CHECKOUT  Page
    Route::controller(CheckOutController::class)->group(function () {
        Route::get('/city-get/ajax/{district_id}', 'GetCityAjax');
        Route::get('/state-get/ajax/{city_id}', 'GetStateAjax');

        Route::post('/checkout/store', 'StoreCheckout')->name('checkout.store');
    });

    // For STRIPE ALL ROUTE
    Route::controller(StripeController::class)->group(function () {
        Route::post('/stripe/order', 'StripeOrder')->name('stripe.order');
        Route::post('/cash/order', 'CashOrder')->name('cash.order');

        Route::post('/khalti/verification', 'KhaltiVerification')->name('khalti.payment');

        Route::get('/khalti/callback', 'KhaltiCallback')->name('khalti.callback');
    });

    // For User Dashboard
    Route::controller(AllUserController::class)->group(function () {
        Route::get('/user/account/page', 'UserAccount')->name('user.account.page');
        Route::get('/user/change/password', 'UserChangePassword')->name('user.change.password');
        Route::get('/user/order/page', 'UserOrderPage')->name('user.order.page');

        Route::get('/user/order_details/{order_id}', 'UserOrderDetails');
        Route::get('/user/invoice_download/{order_id}', 'UserInvoiceDownload');

        Route::post('/return/order/{order_id}', 'ReturnOrder')->name('return.order');
        Route::get('/return/order/page', 'ReturnOrderPage')->name('return.order.page');


        // ORDER TRACKING
        Route::get('/user/track/order', 'UserTrackOrder')->name('user.track.order');
        Route::post('/order/tracking', 'OrderTracking')->name('order.tracking');
    });
});


// ------------- ^^ USER MIDDLE WARE END ^^

// For CART Page
Route::controller(CartController::class)->group(function () {
    Route::get('/myCart', 'MyCart')->name('myCart');
    Route::get('/get-cart-product', 'GetCartProduct');
    Route::get('/remove-mycart/{rowId}', 'RemoveMyCart');
    Route::get('/cart-decrement/{rowId}', 'CartDecrement');
    Route::get('/cart-increment/{rowId}', 'CartIncrement');
});



// For khalti
// Route::get('/khalti/initiate', function () {
//     $url = "https://a.khalti.com/api/v2/epayment/initiate/";
//     $curl = curl_init();
//     curl_setopt_array($curl, array(
//         CURLOPT_URL => $url,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => '',
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 0,
//         CURLOPT_FOLLOWLOCATION => true,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => 'POST',
//         CURLOPT_POSTFIELDS => '{
//             "return_url": "http://example.com/",
//             "website_url": "https://example.com/",
//             "amount": "1000",
//             "purchase_order_id": "Order01",
//                 "purchase_order_name": "test",

//             "customer_info": {
//                 "name": "Test Bahadur",
//                 "email": "test@khalti.com",
//                 "phone": "9800000001"
//             }
//         }

//         ',
//         CURLOPT_HTTPHEADER => array(
//             'Authorization: key 189c72dd39804d72aaba91de589b2882',
//             'Content-Type: application/json',
//         ),
//     ));

//     $response = curl_exec($curl);

//     curl_close($curl);
//     Redirect::to($response->payment_url);

// })->name('khalti.initiate');









require __DIR__ . '/auth.php';
