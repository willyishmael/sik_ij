<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BangunanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerangkatKelurahanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LogoutController::class, 'logout']);
Route::post('/auth', [AuthController::class, 'checkUserToken']);

Route::post('/dashboard', [DashboardController::class,'showCount']);

Route::post('/penduduk/show', [PendudukController::class,'show']);
Route::post('/penduduk/create', [PendudukController::class,'create']);
Route::post('/penduduk/update', [PendudukController::class,'update']);
Route::post('/penduduk/delete', [PendudukController::class,'delete']);

Route::post('/kelurahan/show', [KelurahanController::class,'show']);
Route::post('/kelurahan/update/profil', [KelurahanController::class,'updateProfil']);
Route::post('/kelurahan/update/lurah', [KelurahanController::class,'updateLurah']);
Route::post('/kelurahan/update/sekretaris', [KelurahanController::class,'updateSekretaris']);
Route::get('/kelurahan/perangkat', [PerangkatKelurahanController::class,'unassignedPerangkat']);

Route::post('/bangunan/map', [BangunanController::class,'map']);
Route::post('/bangunan/search', [BangunanController::class,'search']);
