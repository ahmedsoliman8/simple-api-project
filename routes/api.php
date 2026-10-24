<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\DomainController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Auth Modula
Route::controller(AuthController::class)->group(function () {

    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

//Auth Setting
Route::get('/settings', SettingController::class);
//Auth City
Route::get('/cities', CityController::class);
//Auth Distract
Route::get('/districts', DistrictController::class);
//Auth Message

Route::post('/message', MessageController::class);
//Auth Domain

Route::get('/domains', DomainController::class);

