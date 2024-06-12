<?php

use App\Http\Controllers\ParkingController;
use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/t2', function () {
    return ('welcome from api');
});

Route::post('new-parking',[ParkingController::class,'park']); //can remove later, this will cover below

Route::post('end-parking',[ParkingController::class,'exitPark']);

Route::get('view-parking',[ParkingController::class,'viewPark']);

Route::delete('delete-parking',[ParkingController::class,'deletePark']);

Route::get('allParkingSpots',[ParkingController::class,'spots']);

Route::get('/allParkingSpots/{id}',[ParkingController::class,'spots']);

Route::post('booking', [BookingController::class, 'book']);