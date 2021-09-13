<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->group(function () {
    Route::prefix('/admin')->name('')->group(function() {
        Route::get('/', [AdminController::class, '']);
    });

    Route::prefix('/operator')->name('')->group(function() {
        Route::post('/datapenduduk', [OperatorController::class, 'store'])->name('store');
        Route::put('/datapenduduk', [OperatorController::class, 'update'])->name('update');
        Route::delete('/datapenduduk', [OperatorController::class, 'destroy'])->name('destroy');
    });

    // Route::get('/dashboard', [DashboardController::class,'jumlahPendudukKelurahan']);
});

// Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::get('/logout', [LogoutController::class, 'logout'])->middleware('auth');
Route::post('/dashboard', [DashboardController::class,'jumlahPendudukKelurahan']);


// Route::get('/auth', [LoginController::class, 'auth']);

// Route::get('/authrole', [LoginController::class, 'authrole']);