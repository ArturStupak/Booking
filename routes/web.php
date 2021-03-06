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

Route::get('/search', 'App\Http\Controllers\PlaceController@search')->name('search');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/place/edit/{placeId}', [App\Http\Controllers\PlaceController::class, 'edit'])->name('place.edit');
Route::post('/place/rating',[App\Http\Controllers\PlaceController::class, 'saveRating'])->name('place.saverating');

Route::get('/place/myAds', [App\Http\Controllers\PlaceController::class, 'myAds'])->name('places.myAds');
Route::resource('/place', 'App\Http\Controllers\PlaceController');
Route::post('/delete/image/', [App\Http\Controllers\PlaceController::class, 'deleteImage'])->name('places.deleteImage');
Route::get('/delete/place/{placeId}', [App\Http\Controllers\PlaceController::class, 'deletePlace'])->name('places.deletePlace');
Route::get('/rezervation/{placesId}', [App\Http\Controllers\BookingController::class, 'rezervation'])->name('booking.rezervation');
Route::post('/booking/', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');
Route::get('/bookings', [App\Http\Controllers\BookingController::class, 'seen'])->name('booking.seen');
Route::get('/booking/accept/{bookingId}', [App\Http\Controllers\BookingController::class, 'accept'])->name('booking.accept');
Route::get('/delete/{id}', [App\Http\Controllers\BookingController::class, 'deleteBooking'])->name('booking.deleteBooking');
Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
Route::get('/admin/show/{userId}', [App\Http\Controllers\AdminController::class, 'show'])->name('admin.show');
Route::get('/admin/userUpdate/{userId}', [App\Http\Controllers\AdminController::class, 'show'])->name('admin.show');
Route::Post('/admin/update', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.update');
Route::get('/admin/userPlaces/{userId}', [App\Http\Controllers\AdminController::class, 'userPlaces'])->name('admin.userPlaces');
Route::get('/access', [App\Http\Controllers\HomeController::class, 'access'])->name('access');
Route::get('/', [App\Http\Controllers\PlaceController::class, 'index'])->name('place.index');
Route::get('/filter', [App\Http\Controllers\PlaceController::class, 'filter'])->name('place.filter');
//Route::get('/', [App\Http\Controllers\HomeController::class, 'landingpage'])->name('homepage');
Route::post('/comment',[App\Http\Controllers\CommentsController::class, 'store'])->name('comment');
Route::get('/delete/comment/{commentId}', [App\Http\Controllers\CommentsController::class, 'deleteComment'])->name('comments.delete');








