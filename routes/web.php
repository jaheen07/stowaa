<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontendcontroller;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\subcategoryController;
use App\Http\controllers\productController;
use App\Http\controllers\log_regController;
use App\Http\controllers\customerloginController;
use App\Http\controllers\productdetailsController;
use App\Http\controllers\cartController;
use App\Http\controllers\checkoutController;
use App\Http\controllers\couponController;
use App\Http\controllers\deleteController;
use App\Http\controllers\BkashController;
use App\Http\controllers\BkashRefundController;
use App\Http\controllers\SslCommerzPaymentController;
use App\Http\controllers\passController;
use App\Http\controllers\StripePaymentController;
use App\Http\controllers\orderController;
use App\Http\controllers\bannerController;
use App\Http\controllers\reviewcontroller;
use App\Http\controllers\socialloginController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/',[frontendcontroller::class,'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about_us',[frontendcontroller::class,'about_us']);

Route::get('/shop',[frontendcontroller::class,'shop']);
Route::get('/categorywise_shop/{category_id}/{subcategory_id}',[frontendcontroller::class,'categorywise_shop']);
Route::get('/wishlist',[frontendcontroller::class,'wishlist']);

Route::get('/selected_subcategory/{category_id}/{subcategory_id}',[frontendcontroller::class,'categorywise_shop']);
Route::get('/product_details/{pro_id}',[productdetailsController::class,'index']);
Route::post('/search',[frontendcontroller::class,'search']);

//contact us
Route::get('/contact_us',[frontendcontroller::class,'contact_us']);
Route::post('/feedback_contact',[frontendcontroller::class,'feedback']);

//account
Route::get('/account',[frontendcontroller::class,'account']);
Route::post('/order_type',[frontendcontroller::class,'account']);
Route::post('/info_update',[frontendcontroller::class,'info_update']);


//category
Route::get('/category',[categoryController::class,'category']);
Route::post('/category/insert',[categoryController::class,'insert']);

//subcategory
Route::get('/sub_category',[subcategoryController::class,'subcategory']);
Route::post('/subcategory/insert',[subcategoryController::class,'insert']);

//products
Route::get('/products',[productController::class,'index']);
Route::post('/getSubcategory',[ProductController::class,'getSubcategory']);
Route::post('/product/insert',[ProductController::class,'insert'])->name('product.insert');

//orders
Route::get('/orders',[orderController::class,'index']);
Route::get('/orders/details/{id}',[orderController::class,'index']);
Route::get('/orders/packaging/{package_id}',[orderController::class,'package']);
Route::get('/orders/shipping/{shipping_id}',[orderController::class,'shipping']);
Route::get('/orders/delivery_complete/{delivery_id}',[orderController::class,'delivery']);

//tracking-order
Route::get('/track-order',[frontendcontroller::class,'track_order_index']);
Route::get('/tracking/{order_id}',[frontendcontroller::class,'tracking_index']);

//city
Route::get('/getcity/{country_id}',[checkoutController::class,'getcity']);

//login-register
Route::get('/log_reg',[frontendcontroller::class,'log_reg']);
Route::post('/customer/login',[customerloginController::class,'customer_login']);
Route::post('/customer/register',[customerloginController::class,'customer_register']);
Route::get('/customer/logout',[customerloginController::class,'customer_logout']);

//cart
Route::post('/cart',[cartController::class,'index']);
Route::get('/side/delete',[cartController::class,'cart_delete']);
Route::get('/cart/list',[cartController::class,'cart_list']);

//coupons
Route::get('/coupons',[couponController::class,'coupon']);
Route::post('/coupon/insert',[couponController::class,'coupon_insert']);
Route::post('/apply_coupon',[couponController::class,'apply_coupon']);

//checkout
Route::post('/checkout',[checkoutController::class,'index']);


//payment
Route::post('/payment',[checkoutController::class,'payment']);


//deletes
Route::get('/category/delete/{id}',[deleteController::class,'category_delete']);
Route::get('/sub_category/delete/{id}',[deleteController::class,'sub_category_delete']);
Route::get('/remove/{id}',[deleteController::class,'cart_delete']);
Route::get('/delete/banner/{id}',[deleteController::class,'banner_delete']);
Route::get('/delete/wishlist/{id}',[deleteController::class,'wishlist_delete']);

//forget_pass
Route::get('/forgot_pass',[passController::class,'index']);
Route::post('/send_link',[passController::class,'get_link']);
Route::get('/reset_pass/{token}',[passController::class,'reset']);
Route::post('/reseted',[passController::class,'success']);

//stripe
Route::get('/stripe', [StripePaymentController::class, 'stripe']);
Route::post('/stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

//newsletter
Route::post('/newsletter',[frontendcontroller::class,'newsletter']);

//banner
Route::get('/banner',[bannerController::class,'banner']);
Route::post('/getproduct',[bannerController::class,'getproduct']);
Route::post('/banner/insert',[bannerController::class,'banner_insert']);

//wishlist
Route::get('/getbooked',[frontendcontroller::class,'wishlist_insert']);


//inventory
Route::get('/inventory/{id}',[frontendcontroller::class,'inventory']);
Route::post('/inventory/insert',[frontendcontroller::class,'inventory_insert']);

//review
Route::post('/review',[reviewcontroller::class,'review']);

//email check
Route::get('/check_email',[log_regController::class,'email']);
Route::get('/check_pass',[log_regController::class,'pass']);

//get size
Route::post('/getsize',[productdetailsController::class,'getsize']);
Route::post('/getstock',[productdetailsController::class,'getstock']);

//github login

Route::get('/github/redirect',[socialloginController::class,'goto_github']);
Route::get('/github/callback',[socialloginController::class,'github_callback']);

//google
Route::get('/google/redirect',[socialloginController::class,'goto_google']);
Route::get('/google/callback',[socialloginController::class,'google_callback']);

//facebook login
//facebook login
Route::get('/facebook/redirect',[socialloginController::class,'goto_facebook']);
Route::get('/facebook/callback',[socialloginController::class,'facebook_callback']);