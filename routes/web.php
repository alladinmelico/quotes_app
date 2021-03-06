<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/quotes',[QuoteController::class,'getIndex'])->name('index');
Route::post('/quotes',[QuoteController::class,'postQuote'])->name('create');
Route::get('/delete/{quote_id}',[QuoteController::class, 'deleteQuote'])->name('delete');
Route::get('/gotemail/{author_name}',[QuoteController::class, 'getMailCallback'])->name('mail_callback');
Route::get('/admin/login',[AdminController::class, 'getLogin'])->name('admin.login');
Route::post('/admin/login',[AdminController::class,'postLogin'])->name('admin.login');
Route::get('/admin/dashboard',[AdminController::class,'getDashboard'])
    ->middleware('auth')
    ->name('admin.dashboard');
Route::get('/admin/logout',[AdminController::class,'getLogout'])->name('admin.logout');


Route::get('/add-to-cart/{id}', [ProductController::class,'getAddToCart'])->name('product.addToCart');
Route::get('/shopping-cart', [ProductController::class,'getCart'])->name('product.shoppingCart');
Route::get('/checkout', [ProductController::class,'postCheckout'])->name('checkout')->middleware('auth');
Route::get('/remove/{id}', [ProductController::class,'getRemoveItem'])->name('product.remove');
Route::get('/reduce/{id}', [ProductController::class,'getReduceByOne'])->name('product.reduceByOne');
Route::resource('/product', ProductController::class);


Route::group(['prefix' => 'user'], function(){
    Route::group(['middleware' => 'guest'], function() {
        Route::get('/signup', [UserController::class,'getSignup'])->name('user.signup');
        Route::get('/signin', [UserController::class,'getSignin'])->name('user.signin');
        Route::post('/signup', [UserController::class,'postSignup'])->name('user.signup');
        Route::post('/signin', [UserController::class,'postSignin'])->name('user.signin');

    });

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/profile', [UserController::class,'getProfile'])->name('user.profile');
    });

    Route::get('/logout', [UserController::class,'getLogout'])->name('user.logout');
});