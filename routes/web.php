<?php

use App\Http\Controllers\{HomeController,PageController};
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/vehicle/list', [PageController::class, 'vehicleList'])->name('vehicle.list');
Route::get('/vehicle/details', [PageController::class, 'vehicleDetail'])->name('vehicle.details');
Route::get('/owner/vehicle-list', [PageController::class, 'ownerCars'])->name('owner.car');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});

Route::middleware(['auth', 'is_client'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/user/cart', [HomeController::class, 'userCart'])->name('user.cart');
});

Auth::routes();
