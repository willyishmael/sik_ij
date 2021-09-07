<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/login', [LoginController::class, 'index'])->name('login');//->middleware('guest');
// Route::post('/login', [LoginController::class, 'authenticate']);

// Route::get('/dashboard', [DashboardController::class, 'index']);//->middleware('auth');

// // Route::get('/admin', 'AdminController@index');
// // Route::get('/superadmin', 'SuperAdminController@index');

// Route::get('/admin', [AdminController::class, 'index']);
// Route::get('/superadmin', [SuperAdminController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
