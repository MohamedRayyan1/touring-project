<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashBoard_Controller;
use App\Http\Controllers\TouringController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


    Route::post('register' , [AuthController::class,'register']);
    Route::post('login' , [AuthController::class,'login']);
    Route::post('show_profile/{id}' , [TouringController::class,'show_profile']);
    Route::post('search_OnTravel' , [TouringController::class,'search_OnTravel']);




        Route::post('add_comment/{travel_touring_id}' , [TouringController::class,'add_comment'])->middleware('jwt.auth','api');
        Route::post('add_rating/{travel_touring_id}' , [TouringController::class,'add_rating'])->middleware('jwt.auth','api');
        Route::post('booking_travel/{travel_id}' ,[TouringController::class ,'booking_travel'])->middleware('jwt.auth','api');
        Route::post('account_delete_me' ,[TouringController::class ,'account_delete_me'])->middleware('jwt.auth','api');
        Route::post('add_profile' , [TouringController::class,'add_profile'])->middleware('jwt.auth','api');
        Route::post('update_profile/{id}' , [TouringController::class,'update_profile'])->middleware('jwt.auth','api');



    Route::group(['Middleware'=>['api','jwt.auth','admin']] , function(){

        Route::post('add_travel' , [DashBoard_Controller::class,'add_Travel']);
        Route::post('delete_Travel/{id}' , [DashBoard_Controller::class,'delete_Travel']);
        Route::post('update_Travel/{id}' , [DashBoard_Controller::class,'update_Travel']);

    });
