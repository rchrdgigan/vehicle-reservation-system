<?php

use App\Http\Controllers\{HomeController,PageController,VehicleController};
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/vehicle/list', [PageController::class, 'vehicleList'])->name('vehicle.list');
Route::get('/vehicle/details', [PageController::class, 'vehicleDetail'])->name('vehicle.details');
Route::get('/owner/vehicle-list', [PageController::class, 'ownerCars'])->name('owner.car');

Route::middleware(['auth', 'is_admin'])->group(function () {
   
    Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
        Route::get('/', [HomeController::class, 'adminHome'])->name('index');
        Route::controller(VehicleController::class)
        ->as('vehicle.')
        ->prefix('vehicle')
        ->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::put('/update', 'update')->name('update');
            Route::delete('/destroy', 'destroy')->name('destroy');
        });
    });
});

Route::middleware(['auth', 'is_client'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/user/cart', [HomeController::class, 'userCart'])->name('user.cart');
});

Auth::routes();
