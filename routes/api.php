<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerangkatKelurahanController;
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

});

Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LogoutController::class, 'logout']);
Route::post('/auth', [AuthController::class, 'checkUserToken']);

Route::post('/penduduk/show', [PendudukController::class,'show']);
Route::post('/penduduk/create', [PendudukController::class,'create']);
Route::post('/penduduk/update', [PendudukController::class,'update']);
Route::post('/penduduk/delete', [PendudukController::class,'delete']);

Route::post('/kelurahan/show', [KelurahanController::class,'show']);
Route::post('/kelurahan/update/profil', [KelurahanController::class,'updateProfil']);
Route::post('/kelurahan/update/lurah', [KelurahanController::class,'updateLurah']);
Route::post('/kelurahan/update/sekretaris', [KelurahanController::class,'updateSekretaris']);
Route::get('/kelurahan/perangkat', [PerangkatKelurahanController::class,'unassignedPerangkat']);