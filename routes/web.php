<?php

use Illuminate\Support\Facades\Route;
// admin controller route use 
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomeModelController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReviewController;


// front controller route use 
use App\Http\Controllers\Front\FrontController;


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


// front route start here 
Route::get('/',[FrontController::class,'index']);
Route::get('products/{slug}',[FrontController::class,'productShow']);
Route::get('category/{slug}',[FrontController::class,'category']);
Route::post('add_cart_url',[FrontController::class,'add_cart_url']);
Route::post('statefinder',[FrontController::class,'statefinder']);
Route::post('statefindercheckout',[FrontController::class,'statefindercheckout']);
Route::post('/frmRegistration',[FrontController::class,'frmRegistration']);
Route::post('/frmLogin',[FrontController::class,'frmLogin']);
Route::post('cityfinder',[FrontController::class,'cityfinder']);
Route::post('cityfindercheckout',[FrontController::class,'cityfindercheckout']);
Route::get('cart',[FrontController::class,'cart']);
Route::get('/search/{str}',[FrontController::class,'search']);
Route::get('register',[FrontController::class,'register']);
Route::get('verification/{id}',[FrontController::class,'verification']);
Route::get('forgot_password/{id}',[FrontController::class,'forgot_password']);
Route::post('forget_pass_email',[FrontController::class,'forget_pass_email']);
Route::post('update_password_process',[FrontController::class,'update_password_process']);
Route::get('checkout',[FrontController::class,'checkout']);
Route::get('orderplaced',[FrontController::class,'orderplaced']);
Route::get('online_payment',[FrontController::class,'online_payment']);
Route::post('coupon_process',[FrontController::class,'coupon_process']);
Route::post('couponRemove',[FrontController::class,'couponRemove']);
Route::post('frmCheckout',[FrontController::class,'frmCheckout']);
Route::post('newsetter_process',[FrontController::class,'newsetter_process']);
Route::post('rating_process',[FrontController::class,'rating_process']);

Route::middleware('user_Auth')->group(function (){
    Route::get('order',[FrontController::class,'order']);
    Route::get('order_detail/{id}',[FrontController::class,'order_detail']);
});


Route::get('/logout',function () {
    session()->forget('FRONT_LOGGEDIN');
    session()->forget('FRONT_USERNAME');
    session()->forget('FRONT_USERID');
    session()->flash('logoutmsg','Logout Successful.');
    return redirect('/');
});




// admin dashbord route start here   

Route::get('admin',[AdminController::class,'index']);
Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');

Route::middleware(['adminAuth'])->group(function () {
    Route::get('admin/dashboard',[AdminController::class,'dashboard']);

    //category routes
    Route::get('admin/category',[CategoryController::class,'index']); //category home controller
    Route::get('admin/category/manage-categories',[CategoryController::class,'manage_category']);    //add category page
    Route::get('admin/category/manage-categories/{id}',[CategoryController::class,'manage_category']);   //edit category page
    Route::get('/admin/category/delete/{id}',[CategoryController::class,'delete']);  //delete category page
    Route::get('/admin/category/status/{status}/{id}',[CategoryController::class,'status']);  //delete category page
    Route::post('admin/category/manage-categories-process',[CategoryController::class,'manage_category_process'])->name('category.category_process');
    //Route::post('admin/category/manage-categories-process/{id}',[CategoryController::class,'manage_category_process'])->name('category.category_process');


    //Coupon controllers and route
    Route::get('admin/coupon',[CouponController::class,'index']); //category home controller
    Route::get('admin/coupon/manage-coupon',[CouponController::class,'manage_coupon']);    //add category page
    Route::get('admin/coupon/manage-coupon/{id}',[CouponController::class,'manage_coupon']);   //edit category page
    Route::get('/admin/coupon/delete/{id}',[CouponController::class,'delete']);  //delete category page
    Route::get('/admin/coupon/status/{status}/{id}',[CouponController::class,'status']);  //delete category page
    Route::post('admin/coupon/manage-coupon-process',[CouponController::class,'manage_coupon_process'])->name('coupon.coupon_process');


    //Size controllers and route
    Route::get('admin/size',[SizeController::class,'index']); //category home controller
    Route::get('admin/size/manage-size',[SizeController::class,'manage_size']);    //add category page
    Route::get('admin/size/manage-size/{id}',[SizeController::class,'manage_size']);   //edit category page
    Route::get('/admin/size/delete/{id}',[SizeController::class,'delete']);  //delete category page
    Route::get('/admin/size/status/{status}/{id}',[SizeController::class,'status']);  //delete category page
    Route::post('admin/size/manage-size-process',[SizeController::class,'manage_size_process'])->name('size.size_process');


    //home banner routes
    Route::get('admin/banner',[HomeModelController::class,'index']); //category home controller
    Route::get('admin/banner/manage-banner',[HomeModelController::class,'manage_banner']);    //add category page
    Route::get('admin/banner/manage-banner/{id}',[HomeModelController::class,'manage_banner']);   //edit category page
    Route::get('/admin/banner/delete/{id}',[HomeModelController::class,'delete']);  //delete category page
    Route::get('/admin/banner/status/{status}/{id}',[HomeModelController::class,'status']);  //delete category page
    Route::post('admin/banner/manage-banner-process',[HomeModelController::class,'manage_banner_process'])->name('banner.banner_process');

    //Tax controllers and route
    Route::get('admin/tax',[TaxController::class,'index']); //category home controller
    Route::get('admin/tax/manage-tax',[TaxController::class,'manage_tax']);    //add category page
    Route::get('admin/tax/manage-tax/{id}',[TaxController::class,'manage_tax']);   //edit category page
    Route::get('/admin/tax/delete/{id}',[TaxController::class,'delete']);  //delete category page
    Route::get('/admin/tax/status/{status}/{id}',[TaxController::class,'status']);  //delete category page
    Route::post('admin/tax/manage-tax-process',[TaxController::class,'manage_tax_process'])->name('tax.tax_process');


    //color controllers and route
    Route::get('admin/color',[ColorController::class,'index']); //category home controller
    Route::get('admin/color/manage-color',[ColorController::class,'manage_color']);    //add category page
    Route::get('admin/color/manage-color/{id}',[ColorController::class,'manage_color']);   //edit category page
    Route::get('/admin/color/delete/{id}',[ColorController::class,'delete']);  //delete category page
    Route::get('/admin/color/status/{status}/{id}',[ColorController::class,'status']);  //delete category page
    Route::post('admin/color/manage-color-process',[ColorController::class,'manage_color_process'])->name('color.color_process');


    //brand controller and route
    Route::get('admin/brand',[BrandController::class,'index']); //category home controller
    Route::get('admin/brand/manage-brand',[BrandController::class,'manage_brand']);    //add category page
    Route::get('admin/brand/manage-brand/{id}',[BrandController::class,'manage_brand']);   //edit category page
    Route::get('/admin/brand/delete/{id}',[BrandController::class,'delete']);  //delete category page
    Route::get('/admin/brand/status/{status}/{id}',[BrandController::class,'status']);  //delete category page
    Route::post('admin/brand/manage-brand-process',[BrandController::class,'manage_brand_process'])->name('brand.brand_process');


    //product controller and route
    Route::get('admin/product',[ProductController::class,'index']); //category home controller
    Route::get('admin/product/manage-product',[ProductController::class,'manage_product']);    //add category page
    Route::get('admin/product/manage-product/{id}',[ProductController::class,'manage_product']);   //edit category page
    Route::get('/admin/product/delete/{id}',[ProductController::class,'delete']);  //delete category page
    Route::get('/admin/product/status/{status}/{id}',[ProductController::class,'status']);  //delete category page
    Route::get('/admin/product/manage-product/product_attr_delete/{id}',[ProductController::class,'product_attr_delete']);  //delete category page
    Route::get('/admin/product/manage-product/product_image_delete/{id}',[ProductController::class,'product_image_delete']);  //delete category page
    Route::post('admin/product/manage-product-process',[ProductController::class,'manage_product_process'])->name('product.product_process');



    //customer controllers and route
    Route::get('admin/customer',[CustomerController::class,'index']); //category home controller
    Route::get('admin/customer/show/{id}',[CustomerController::class,'show']);   //edit category page
    Route::get('/admin/customer/status/{status}/{id}',[CustomerController::class,'status']);  //delete category page
    
    //order page route 
    Route::get('/admin/order',[OrderController::class,'index']);
    Route::get('/admin/order_detail/{id}',[OrderController::class,'order_detail']);
    Route::post('/admin/order_detail/{id}',[OrderController::class,'trackStatus']);
    Route::get('/admin/orderStatus/{status}/{id}',[OrderController::class,'orderStatus']);
    Route::get('/admin/paymentStatus/{status}/{id}',[OrderController::class,'paymentStatus']);

    //customer reviews route
    Route::get('/admin/reviews',[ReviewController::class,'index']);
    Route::get('/admin/review_process/{status}/{id}',[ReviewController::class,'review_process']);



    
    Route::get('admin/logout',function () {
        session()->forget('admin_login');
        session()->forget('user');
        session()->forget('user_id');
        session()->flash('msg','Logout Successful.');
        return redirect('admin');
    });
});