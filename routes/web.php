<?php

use App\Http\Controllers\Web\admin\WebDeviceController;
use App\Http\Controllers\Web\admin\WebUserController;
use App\Http\Controllers\Web\peternak\DashboardController;
use App\Http\Controllers\Web\peternak\WebConfigLampController;
use App\Http\Controllers\Web\peternak\WebHeaterConfigController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Login biar kalau ketik /dashboard engga langsung ke login

// Route::get('/login', function () {
//     return view('auth.login');
// });

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/auth/register', [AuthController::class, 'register_process']);

Route::middleware('breeder')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/heater', [WebHeaterConfigController::class, 'index']);
    Route::put('/heater/{configHeater}', [WebHeaterConfigController::class, 'index']);
    //Web breeder Lamp
    Route::resource('/lamp', WebConfigLampController::class, ['parameters' => ['lamp' => 'configLamp']]);
});



Route::middleware('admin')->group(function () {

    //Web admin/user
    Route::resource('/admin/user', WebUserController::class);

    //Web admin/device
    Route::resource('/admin/device', WebDeviceController::class, ['parameters' => ['device' => 'devices']]);

});





// Route::get('/lamp/create', function () {
//     return view('peternak.CreateLamp');
// });

// Route::get('/lamp/update', function () {
//     return view('peternak.UpdateLamp');
// });

// dashboard role peternak
// Route::get('/dashboard', function () {
//     return view('peternak.index');
// });

