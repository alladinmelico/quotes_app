<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;
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

// Route::get('/delete/{quote_id}',[
//     'uses' => 'QuoteController@deleteQuote',
//     'as' => 'delete'
//     ]);