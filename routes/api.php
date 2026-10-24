<?php

use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\DomainController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/settings', SettingController::class);
Route::get('/cities', CityController::class);
Route::get('/districts', DistrictController::class);

Route::post('/message', MessageController::class);

Route::get('/domains', DomainController::class);

