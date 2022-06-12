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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'landingpage'])->name('homepage');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/place/edit/{placeId}', [App\Http\Controllers\PlaceController::class, 'edit'])->name('place.edit');
Route::get('/place/myAds', [App\Http\Controllers\PlaceController::class, 'myAds'])->name('places.myAds');
Route::resource('/place', 'App\Http\Controllers\PlaceController');


