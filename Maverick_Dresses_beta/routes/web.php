<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Login_adminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ForgetPassword;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TotalController;
use App\Http\Controllers\PayPalController;



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

Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction/{total_paypal}', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');



Route::get('/',[HomeController::class, 'home'])->name('home');
Route::get('home', [HomeController::class, 'home'])->name('home');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('productdetails/{id}', [HomeController::class, 'productdetails'])->name('productdetails');
Route::get('confirmation', [HomeController::class, 'confirmation'])->middleware('login')->name('confirmation');


// history
Route::get('historyorder', [HomeController::class, 'historyorder'])->middleware('login')->name('historyorder'); 
Route::post('form_order', [HomeController::class, 'form_order'])->name('form_order');
Route::get('paypal', [HomeController::class, 'paypal'])->middleware('login')->name('paypal'); 


Route::name('user.')->middleware('login')->group(function () {
    Route::prefix('profile')->name('profile.')->group(function(){
        Route::get('index',[HomeController::class,'profile'])->name('profile');
        Route::post('update-profile/{id}',[HomeController::class,'updateProfile'])->name('updateProfile');
        Route::post('update-password/{id}',[HomeController::class,'updatePassword'])->name('updatePassword');
    });
    Route::prefix('history')->name('history.')->group(function(){
        Route::get('history_detail/{id}', [HomeController::class, 'history_detail'])->name('history_detail');
        Route::post('cancal_cart/{id}', [HomeController::class, 'cancal_cart'])->name('cancal_cart');
        Route::post('returns/{id}', [HomeController::class, 'returns'])->name('returns'); 
    });
});

Route::get('cart', [HomeController::class, 'shopingcart'])->middleware('login')->name('shopingcart');
Route::get('shopcategory/{id}', [HomeController::class, 'shopcategory'])->name('shopcategory');
Route::post('them-vao-gio-hang/{id}', [HomeController::class, 'addToCart'])->name('addToCart');
Route::post('them-vao-gio-hang-update/{id}', [HomeController::class, 'addToCart2'])->name('addToCart2');
Route::get('deleteCart/{id}', [HomeController::class, 'deleteCart'])->name('deleteCart');
Route::get('confirm', [HomeController::class, 'confirm'])->name('confirm');
Route::post('get-comments/{id}', [HomeController::class, 'getComment'])->middleware('login')->name('getComment');



// showproduct
Route::get('masterproduct/{id}', [HomeController::class, 'masterproduct'])->name('masterproduct');

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('registers', [LoginController::class, 'registers'])->name('registers');
Route::post('sinup', [LoginController::class, 'sinup'])->name('sinup');

//confirm_mail_register
Route::get('fill-confirm-code-mail-register', [LoginController::class,'fillConfirmCodeMailRegisTerView'])->name('fillConfirmCodeMailRegisTerView');
Route::post('fill-confirm-code-mail-register', [LoginController::class,'fillConfirmCodeMailRegisTer'])->name('fillConfirmCodeMailRegisTer');


Route::get('login_admin', [Login_adminController::class, 'login_admin'])->name('login_admin');
Route::post('postlogin_admin', [Login_adminController::class, 'postlogin_admin'])->name('postlogin_admin');
Route::get('logout_admin', [Login_adminController::class, 'logout_admin'])->name('logout_admin');


Route::get('forget-password', [ForgetPassword::class, 'forget_pass'])->name('forget_pass');
Route::post('recover-pass', [ForgetPassword::class,'recoverPass'])->name('recoverPass');
Route::get('fill-confirm-code', [ForgetPassword::class,'fillConfirmCodeView'])->name('fillConfirmCodeView');
Route::post('fill-confirm-code', [ForgetPassword::class,'fillConfirmCode'])->name('fillConfirmCode');
Route::get('fill-new-password-view/{id}', [ForgetPassword::class,'fillNewPasswordView'])->name('fillNewPasswordView');
Route::post('fill-new-password/{id}', [ForgetPassword::class,'fillNewPassword'])->name('fillNewPassword');


Route::prefix('admin')->middleware('login_admin')->name('admin.')->group(function(){
    Route::prefix('total')->name('total.')->group(function () {
        
        Route::get('quater_1',[TotalController::class,'quater_1'])->name('quater_1');
        Route::post('post_quater',[TotalController::class,'post_quater'])->name('post_quater');
        Route::get('get_quater/{year}/{quater}',[TotalController::class,'get_quater'])->name('get_quater');
        Route::get('total_month',[TotalController::class,'total_month'])->name('total_month');
        Route::post('post_total_month',[TotalController::class,'post_total_month'])->name('post_total_month');
        Route::get('get_total_month/{year}/{month}',[TotalController::class,'get_total_month'])->name('get_total_month');

    });

    Route::prefix('category')->name('category.')->group(function(){
        Route::get('create', [CateController::class, 'create'])->name('create');
        Route::post('stote', [CateController::class, 'store'])->name('store');
        Route::get('index', [CateController::class, 'index'])->name('index');
        Route::post('update/{id}', [CateController::class, 'update'])->name('update')->where('id', '[0-9]+');
        Route::get('edit/{id}', [CateController::class, 'edit'])->name('edit')->where('id', '[0-9]+');
        Route::get('delete/{id}', [CateController::class, 'delete'])->name('delete')->where('id', '[0-9]+');

    });
    Route::prefix('product')->name('product.')->group(function(){

        Route::post('ckeditor/image_upload', [ProductController::class, 'upload'])->name('upload');


        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('stote', [ProductController::class, 'store'])->name('store');
        Route::get('index', [ProductController::class, 'index'])->name('index');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('update')->where('id', '[0-9]+');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit')->where('id', '[0-9]+');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('delete')->where('id', '[0-9]+');

        Route::get('createsize', [ProductController::class, 'createsize'])->name('createsize');
        Route::post('storesizes', [ProductController::class, 'storesizes'])->name('storesizes');
        Route::get('indexsize', [ProductController::class, 'indexsize'])->name('indexsize');
        // Route::get('editsize/{id}', [ProductController::class, 'editsize'])->name('editsize')->where('id', '[0-9]+');
        // Route::post('updatesize/{id}', [ProductController::class, 'updatesize'])->name('updatesize')->where('id', '[0-9]+');
        Route::get('deletesize/{id}', [ProductController::class, 'deletesize'])->name('deletesize')->where('id', '[0-9]+');
    });
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('index',[UserController::class,'index'])->name('index');
        Route::get('create',[UserController::class,'create'])->name('create');
        Route::post('store',[UserController::class,'store'])->name('store');
        Route::get('edit/{id}',[UserController::class,'edit'])->name('edit')->where('id','[0-9]+');
        Route::post('update/{id}',[UserController::class,'update'])->name('update')->where('id','[0-9]+');
        Route::get('delete/{id}',[UserController::class,'delete'])->name('delete')->where('id','[0-9]+');
    });

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('orders_confirmation',[CartController::class,'orders_confirmation'])->name('orders_confirmation');
        Route::get('order_detail/{id}',[CartController::class,'order_detail'])->name('order_detail')->where('id', '[0-9]+');
        Route::get('edit/{id}',[CartController::class,'edit'])->name('edit')->where('id', '[0-9]+');
        Route::post('update/{id}',[CartController::class,'update'])->name('update')->where('id','[0-9]+');
        Route::get('rating_products',[CartController::class,'rating_products'])->name('rating_products');
        Route::get('delete_rating/{id}',[CartController::class,'delete_rating'])->name('delete_rating');
        Route::get('orders_confirmated',[CartController::class,'orders_confirmated'])->name('orders_confirmated');
        Route::get('orders_delivering',[CartController::class,'orders_delivering'])->name('orders_delivering');
        Route::get('list_order',[CartController::class,'list_order'])->name('list_order');//chỉnh chỗ này
        Route::get('order_cancel',[CartController::class,'order_cancel'])->name('order_cancel');
        Route::get('returns_oder',[CartController::class,'returns_oder'])->name('returns_oder');
        Route::get('list_returns_oder',[CartController::class,'list_returns_oder'])->name('list_returns_oder');
        Route::get('online',[CartController::class,'online'])->name('online');
        Route::get('immidiate',[CartController::class,'immidiate'])->name('immidiate');
        Route::get('comment/{id}',[CartController::class,'comment'])->name('comment');
    });

});
