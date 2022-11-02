<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\TypeController;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/auth')->group(function(){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);

    Route::middleware('auth:sanctum')->group(function(){
        Route::get('/user',[AuthController::class,'user']);
        Route::get('/logout',[AuthController::class,'logout']);
    });
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/manufacturers',[ManufacturerController::class,'index']);
    Route::prefix('/manufacturer')->group(function(){
        Route::post('/',[ManufacturerController::class,'store']);
        Route::get('/{id}',[ManufacturerController::class,'get']);
        Route::put('/{id}',[ManufacturerController::class,'update']);
        Route::delete('/{id}',[ManufacturerController::class,'delete']);
    });
    
    Route::get('/types',[TypeController::class,'index']);
    Route::prefix('/type')->group(function(){
        Route::post('/',[TypeController::class,'store']);
        Route::get('/{id}',[TypeController::class,'get']);
        Route::put('/{id}',[TypeController::class,'update']);
        Route::delete('/{id}',[TypeController::class,'delete']);
    });

    Route::get('/colors',[ColorController::class,'index']);
    Route::prefix('/color')->group(function(){
        Route::post('/',[ColorController::class,'store']);
        Route::get('/{id}',[ColorController::class,'get']);
        Route::put('/{id}',[ColorController::class,'update']);
        Route::delete('/{id}',[ColorController::class,'delete']);
    });

    Route::get('/cars',[CarController::class,'index']);
    Route::prefix('/car')->group(function(){
        Route::post('/',[CarController::class,'store']);
        Route::get('/{id}',[CarController::class,'get']);
        Route::put('/{id}',[CarController::class,'update']);
        Route::delete('/{id}',[CarController::class,'delete']);
    });
});

