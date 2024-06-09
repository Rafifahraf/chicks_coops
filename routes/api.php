<?php

use App\Http\Controllers\Api\ConfigHeaterController;
use App\Http\Controllers\Api\ConfigLampController;
use App\Http\Controllers\Api\DataSensorsController;
use App\Http\Controllers\Api\DevicesController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\APIDashboardController;
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
Route::resource('/user', UserController::class);
Route::resource('/device', DevicesController::class);
Route::resource('/data_sensors', DataSensorsController::class);
Route::resource('/config_lamp', ConfigLampController::class);
Route::resource('/config_heater', ConfigHeaterController::class);
Route::get('/dashboard/{device_id}',[APIDashboardController::class,'index']);
Route::get('/config_device/{device_id}',[APIDashboardController::class,'getConfig']);
