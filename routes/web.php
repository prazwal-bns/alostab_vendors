<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ProvideController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\CoupounController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\User\CheckOutController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\User\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;

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

Route::get('/',[IndexController::class,'Index']);

// Frontend All Product Details Route
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

// vendor details
Route::get('/vendor/details/{id}',[IndexController::class,'VendorDetails'])->name('vendor.details');
Route::get('/vendor/all',[IndexController::class,'VendorAll'])->name('vendor.all');

// Category Product - Nav
Route::get('/product/category/{id}/{slug}', [IndexController::class, 'ProductByCategory']);

// SUb Category Product - Nav
Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'ProductBySubCategory']);



Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
});


// For Google Login => Socialite 
Route::get('/auth/{provider}/redirect',[ProvideController::class,'redirect']);
Route::get('/auth/{provider}/callback',[ProvideController::class,'callback']);


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
    Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');


    Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');
    Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');

    // Vendor Add Product
    Route::controller(VendorProductController::class)->group(function(){
        Route::get('/vendor/all/dashboard', 'VendorAllProduct')->name('vendor.all.product');
        Route::get('/vendor/add/dashboard', 'VendorAddProduct')->name('vendor.add.product');
        Route::get('vendor/subcategory/ajax/{category_id}','VendorGetSubCategory');

        Route::post('/vendor/store/product', 'VendorStoreProduct')->name('vendor.store.product');
        Route::get('/vendor/edit/product/{id}', 'VendorEditProduct')->name('vendor.edit.product');

        Route::post('/vendor/update/product/{id}', 'VendorUpdateProduct')->name('vendor.update.product');
        Route::post('/update/vendor/product/thumbnail/{id}', 'UpdateVendorProductThumbnail')->name('update.vendor.product.thumbnail');

        Route::post('/vendor/update/product/multiimage/{id}' , 'VendorUpdateProductMultiimage')->name('vendor.update.product.multiimage');

        Route::get('vendor/delete/multiimg/product/{id}','VendorMultiImgDelete')->name('vendor.delete.multimg.product');

        Route::get('vendor/inactive/product/{id}','VendorInactiveProduct')->name('vendor.inactive.product');
        Route::get('vendor/active/product/{id}','VendorActiveProduct')->name('vendor.active.product');

        Route::get('vendor/delete/product/{id}','VendorDeleteProduct')->name('vendor.delete.product');
    });
});


// Login Routes
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');



// Brand Controller
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(BrandController::class)->group(function(){
        Route::get('/all/brand','AllBrand')->name('all.brand');
        Route::get('/add/brand','AddBrand')->name('add.brand');
        Route::post('/store/brand','StoreBrand')->name('store.brand');
        
        // edit brand
        Route::get('/edit/brand/{id}','EditBrand')->name('edit.brand');
        // update brand
        Route::post('/update/brand/{id}','UpdateBrand')->name('update.brand');

        // delete brand
        Route::get('/delete/brand/{id}','DeleteBrand')->name('delete.brand');
    });
});


// Category Controller
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category','AllCategory')->name('all.category');
        Route::get('/add/category','AddCategory')->name('add.category');
        Route::post('/store/category','StoreCategory')->name('store.category');

        Route::get('/edit/category/{id}','EditCategory')->name('edit.category');
        Route::post('/update/category/{id}','UpdateCategory')->name('update.category');

        Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');
    });
});


// Sub Category Controller
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory','AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory','StoreSubCategory')->name('store.subcategory');

        Route::get('/edit/subcategory/{id}','EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory/{id}','UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}','DeleteSubCategory')->name('delete.subcategory');


        Route::get('/subcategory/ajax/{category_id}','GetSubCategory');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Vendor Active and Inactive Route
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(AdminController::class)->group(function(){
        Route::get('/inactive/vendor','InactiveVendor')->name('inactive.vendor');
        Route::get('/active/vendor','ActiveVendor')->name('active.vendor');
        Route::get('/inactive/vendor/details/{id}','InactiveVendorDetails')->name('inactive.vendor.details');
        Route::post('/active/vendor/approve','ActiveVendorApprove')->name('active.vendor.approve');

        Route::get('/active/vendor/details/{id}','ActiveVendorDetails')->name('active.vendor.details');
        Route::post('/inactive/vendor/approve','InactiveVendorApprove')->name('inactive.vendor.approve');
        
    });
});



// Admin Middleware, product, sliders banners
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Product Contrller
    Route::controller(ProductController::class)->group(function(){
        Route::get('/all/product','AllProduct')->name('all.product');
        Route::get('/add/product','AddProduct')->name('add.product');

        Route::post('/store/product','StoreProduct')->name('store.product');
        
        Route::get('/edit/product/{id}','EditProduct')->name('edit.product');

        Route::post('/update/product/{id}','UpdateProduct')->name('update.product');
        Route::post('/update/product/thumbnail/{id}','UpdateProductThumbnail')->name('update.product.thumbnail');

        Route::post('/update/product/multiimage/{id}' , 'UpdateProductMultiimage')->name('update.product.multiimage');

        Route::get('/delete/multiimg/product/{id}','DeleteMultiImgProduct')->name('delete.multimg.product');

        Route::get('/inactive/product/{id}','InactiveProduct')->name('inactive.product');
        Route::get('/active/product/{id}','ActiveProduct')->name('active.product');

        Route::get('/delete/product/{id}','DeleteProduct')->name('delete.product');
       
    });

    // Slider Controller
    Route::controller(SliderController::class)->group(function(){
        Route::get('/all/slider','AllSlider')->name('all.slider');
        Route::get('/add/slider','AddSlider')->name('add.slider');
        Route::post('/store/slider','StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}','EditSlider')->name('edit.slider');
        Route::post('/update/slider/{id}','UpdateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}','DeleteSlider')->name('delete.slider');
    });

    // Banner Controller
    Route::controller(BannerController::class)->group(function(){
        Route::get('/all/banner','AllBanner')->name('all.banner');
        Route::get('/add/banner','AddBanner')->name('add.banner');
        Route::post('/store/banner','StoreBanner')->name('store.banner');
        Route::get('/edit/banner/{id}','EditBanner')->name('edit.banner');
        Route::post('/update/banner/{id}','UpdateBanner')->name('update.banner');
        Route::get('/delete/banner/{id}','DeleteBanner')->name('delete.banner');
    });

    // Coupoun Controller
    Route::controller(CoupounController::class)->group(function () {
        Route::get('/all/coupoun', 'AllCoupoun')->name('all.coupoun');
        Route::get('/add/coupoun', 'AddCoupoun')->name('add.coupoun');
        Route::post('/store/coupoun', 'StoreCoupoun')->name('store.coupoun');
        Route::get('/edit/coupoun/{id}', 'EditCoupoun')->name('edit.coupoun');
        Route::post('/update/coupoun/{id}', 'UpdateCoupoun')->name('update.coupoun');
        Route::get('/delete/banner/{id}', 'DeleteCoupoun')->name('delete.coupoun');
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

});
// end admin 


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
    Route::controller(WishlistController::class)->group(function(){
        Route::get('/wishlist','AllWishlist')->name('wishlist');
        Route::get('/get-wishlist-product/','GetWishListProduct');

        Route::get('/wishlist-remove/{id}','WishlistRemove');
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










require __DIR__ . '/auth.php';
