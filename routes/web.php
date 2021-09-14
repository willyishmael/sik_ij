<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SuperAdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class,'jumlahPendudukKelurahan']);

Route::get('/login', [LoginController::class, 'index'])->name('login');//->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/logout', [LogoutController::class, 'logout'])->middleware('auth');

// Route::get('/dashboard', [DashboardController::class, 'index']);//->middleware('auth');

// admin protected routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin_dashboard');
});

// user protected routes
Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
    Route::get('/', 'HomeController@index')->name('user_dashboard');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/kelurahan', [KelurahanController::class, 'showDataKelurahan']);
