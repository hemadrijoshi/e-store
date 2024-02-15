<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('shop', [App\Http\Controllers\HomeController::class, 'Shop'])->name('shop');
Route::get('basket',[App\Http\Controllers\HomeController::class, 'basket'])->name('basket');
Route::post('add-to-cart/{id}',[App\Http\Controllers\HomeController::class, 'AddToCart'])->name('add-to-cart');