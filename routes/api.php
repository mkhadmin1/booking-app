<?php

use App\Http\Controllers\Booking\BookingController;
use App\Http\Controllers\City\CityController;
use App\Http\Controllers\Feedback\FeedbackController;
use App\Http\Controllers\Hotel\HotelController;
use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::get('users/{id}/bookings', [UserController::class, 'showUserBookings']);
Route::get('users/{id}/feedbacks', [UserController::class, 'showUserFeedbacks']);
Route::post('users', [UserController::class, 'store']);
Route::match(['put', 'patch'],'users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);

//Feedbacks
Route::get('feedbacks', [FeedbackController::class, 'index']);
Route::get('feedbacks/{id}', [FeedbackController::class, 'show']);
Route::post('feedbacks', [FeedbackController::class, 'store']);
Route::put('feedbacks/{id}', [FeedbackController::class, 'update']);
Route::delete('feedbacks/{id}', [FeedbackController::class, 'destroy']);


//Cities
Route::get('/cities', [CityController::class, 'index']);
Route::get('/cities/{id}', [CityController::class, 'show']);
Route::post('/cities', [CityController::class, 'store']);
Route::put('/cities/{id}', [CityController::class, 'update']);
Route::delete('/cities/{id}', [CityController::class, 'destroy']);
Route::get('/cities/{id}/hotels', [CityController::class, 'showCityHotels']);

//Rooms
Route::get('/rooms', [RoomController::class, 'index']);
Route::post('/rooms', [RoomController::class, 'store']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);
Route::put('/rooms/{id}', [RoomController::class, 'update']);
Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);

//Bookings
Route::get('bookings', [BookingController::class, 'index']);
Route::get('bookings/{id}', [BookingController::class, 'show']);
Route::post('bookings', [BookingController::class, 'store']);
Route::match(['put', 'patch'],'bookings/{id}', [BookingController::class, 'update']);
Route::delete('bookings/{id}', [BookingController::class, 'destroy']);

// Hotels
Route::get('hotels', [HotelController::class, 'index']);
Route::get('hotels/{id}', [HotelController::class, 'show']);
Route::post('hotels', [HotelController::class, 'store']);
Route::match(['put', 'patch'],'hotels/{id}', [HotelController::class, 'update']);
Route::delete('hotels/{id}', [HotelController::class, 'destroy']);
Route::get('hotels/{id}/feedbacks', [HotelController::class, 'showHotelFeedbacks']);
Route::get('hotels/{id}/available-rooms', [HotelController::class, 'getAvailableRooms']);
