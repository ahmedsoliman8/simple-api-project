<?php

use App\Http\Controllers\Api\AdController;
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

//Setting Modula
Route::get('/settings', SettingController::class);
// City Modula
Route::get('/cities', CityController::class);
// Distract Modula
Route::get('/districts', DistrictController::class);
// Message Modula

Route::post('/message', MessageController::class);
// Domain Modula

Route::get('/domains', DomainController::class);

//Ads Modula
Route::prefix('ads')->controller(AdController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/latest', 'latest');
    Route::get('/domain/{domain_id}', 'domain');
    Route::get('/search', 'search');
    //User Ads Modula
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/create', 'create');
        Route::post('/update', 'update');
        Route::post('/delete', 'delete');
        Route::get('/myads', 'myads');
    });
});


