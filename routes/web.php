<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard/dashboard-v1', [App\Http\Controllers\Dashboard\DashboardV1::class, 'index'])->name('dashboard-v1');
Route::get('/dashboard/dashboard-v2', [App\Http\Controllers\Dashboard\DashboardV2::class, 'index'])->name('dashboard-v2');
Route::get('/dashboard/dashboard-v3', [App\Http\Controllers\Dashboard\DashboardV3::class, 'index'])->name('dashboard-v3');

Route::prefix('dashboard/admin')->middleware(['auth', 'isAdmin'])->group(function () {

    // Category Routes
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index');
        Route::get('/user/create', 'create');
        Route::post('/user', 'store');
        Route::get('/user/{user}/edit', 'edit');
        Route::put('/user/{user}', 'update');
        Route::get('/user/{user}/delete', 'destroy');
    });
});