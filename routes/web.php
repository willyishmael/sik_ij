<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PerangkatKelurahanController;
use App\Http\Controllers\SuperAdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class,'jumlahPendudukKelurahan']);

Route::get('/login', [LoginController::class, 'index'])->name('login');//->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/logout', [LogoutController::class, 'logout'])->middleware('auth');

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin_dashboard');
});

Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
    Route::get('/', 'HomeController@index')->name('user_dashboard');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/penduduk', [PendudukController::class,'jumlahPendudukKelurahan'])->middleware('auth');
Route::get('/kelurahan', [KelurahanController::class, 'show']);
Route::get('/auth', [AuthController::class, 'checkUserToken']);

Route::get('/test', [OperatorController::class, 'test']);

Route::get('/penduduk/show', [PendudukController::class, 'show']);
Route::get('/penduduk/update', [PendudukController::class, 'update']);


Route::get('/kelurahan/perangkat', [PerangkatKelurahanController::class, 'show']);

Route::get('/count', [DashboardController::class, 'showCount']);