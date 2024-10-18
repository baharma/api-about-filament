<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\RatePlanController;
use App\Http\Controllers\RoomController;
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
Route::prefix('/v1')->group(function(){

    Route::get('room',[RoomController::class,'index']);
    Route::get('room/{id}',[RoomController::class,'findId']);
    Route::post('room',[RoomController::class,'store']);
    Route::put('room/{id}', [RoomController::class, 'edit']);
    Route::delete('room/{id}',[RoomController::class,'delete']);


    Route::get('rate-plant',[RatePlanController::class,'index']);
    Route::post('rate-plant',[RatePlanController::class,'creates']);
    Route::put('rate-plant/{id}', [RatePlanController::class, 'update']);
    Route::delete('rate-plant/{id}',[RatePlanController::class,'delete']);

    Route::get('calendar',[CalendarController::class,'index']);
    Route::post('calendar',[CalendarController::class,'create']);
    Route::get('calendars/{id}',[CalendarController::class,'findId']);
    Route::put('calendar/{id}', [CalendarController::class, 'update']);
    Route::delete('calendar/{id}',[CalendarController::class,'delete']);

    Route::get('booking',[BookingController::class,'index']);
    Route::post('booking',[BookingController::class,'store']);
    Route::put('booking/{id}',[BookingController::class,'update']);
    Route::delete('booking/{id}',[BookingController::class,'delete']);


});

