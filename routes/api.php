<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/chutiImagePost',[ApiController::class,'chutiImagePost']);
Route::get('/chutiImageGet',[ApiController::class,'chutiImageGet']);


Route::post('/contactPost',[ApiController::class,'contactPost']);
Route::get('/contactGet',[ApiController::class,'contactGet']);





