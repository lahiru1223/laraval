<?php

use App\Http\Controllers\ParkingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/t2', function () {
    return ('welcome from api');
});

Route::post('new-parking',[ParkingController::class,'park']);

Route::post('end-parking',[ParkingController::class,'exitPark']);

Route::get('view-parking',[ParkingController::class,'viewPark']);

Route::delete('delete-parking',[ParkingController::class,'deletePark']);

Route::get('allParkingSpots',[ParkingController::class,'spots']);
