<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;

// Guest
Route::match(['get'], '/', function(){return redirect('home');});
Route::match(['get'], '/home', [HomeController::class, 'gethomepage'])->name('home');
// Route::match(['get'], '/search/{keyword}', [SearchController::class, 'search'])->name('search');
// Route::match(['get'], '/product/{id}', [ProductController::class, 'getproductpage'])->name('viewproduct');
Route::match(['get'], '/show/{type}/{id}', [HomeController::class, 'show']);

// User_Auth
Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('login');
Route::match(['post'], '/logout', [LoginController::class, 'logout'])->name('logout');
Route::match(['get', 'post'], '/register', [LoginController::class, 'register'])->name('register');

Route::match(['post'],'add-cart', [CartController::class,'save_cart'])->name('addCart');
Route::match(['get'],'show-cart', [CartController::class,'show_cart'])->name('showCart');
Route::match(['post'],'delete-cart', [CartController::class,'delete_cart'])->name('deleteCart');
Route::match(['post'],'update-qty-cart{id}', [CartController::class, 'update_quantity'])->name('updateCart');

//Order_checkout
Route::match(['get'], '/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::match(['post'], '/placeorder', [CheckoutController::class, 'order_place'])->name('placeOrder');

//Order_checkout_ajax_Shipping_fee_calculate
Route::match(['get'], '/getshippingfee', [CheckoutController::class, 'getShippingFee'])->name('getshippingfee');
//Order_checkout_ajax_total_calculate
Route::match(['get'], '/getsubtotal', [CheckoutController::class, 'getTotal'])->name('getSubTotal');


Route::fallback([HomeController::class, 'notFound']);
