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
Route::get('/search', 'App\Http\Controllers\PlaceController@search')->name('search');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/place/edit/{placeId}', [App\Http\Controllers\PlaceController::class, 'edit'])->name('place.edit');
Route::get('/place/myAds', [App\Http\Controllers\PlaceController::class, 'myAds'])->name('places.myAds');
Route::resource('/place', 'App\Http\Controllers\PlaceController');
Route::post('/delete/image/', [App\Http\Controllers\PlaceController::class, 'deleteImage'])->name('places.deleteImage');
Route::get('/delete/place/{placeId}', [App\Http\Controllers\PlaceController::class, 'deletePlace'])->name('places.deletePlace');
//Route::get('about/place/{placeId}',[App\Http\Controllers\PlaceController::class, 'aboutPlace'])->name('places.aboutPlace');
Route::get('/rezervation/{placesId}', [App\Http\Controllers\BookingController::class, 'rezervation'])->name('booking.rezervation');
Route::post('/booking/', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');
Route::get('/bookings', [App\Http\Controllers\BookingController::class, 'seen'])->name('booking.seen');
Route::get('/booking/accept/{bookingId}', [App\Http\Controllers\BookingController::class, 'accept'])->name('booking.accept');
Route::get('/delete/{id}', [App\Http\Controllers\BookingController::class, 'deleteBooking'])->name('booking.deleteBooking');


