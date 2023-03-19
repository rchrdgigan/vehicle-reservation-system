<?php

use App\Http\Controllers\{
    HomeController,
    PageController,
    VehicleController,
    BrandController,
    TypeController,
    UserAccountController,
    CartController,
};
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'welcome'])->name('welcome');
Route::get('/vehicle/list', [PageController::class, 'vehicleList'])->name('vehicle.list');
Route::get('/vehicle/list/brand/{brand}', [PageController::class, 'vehicleFilteredBrand'])->name('vehicle.filter.brand');
Route::get('/vehicle/list/type/{type}', [PageController::class, 'vehicleFilteredType'])->name('vehicle.filter.type');
Route::get('/vehicle/details/{id}', [PageController::class, 'vehicleDetail'])->name('vehicle.details');
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
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/destroy', 'destroy')->name('destroy');
            Route::controller(BrandController::class)
            ->as('brand.')
            ->prefix('brand')
            ->group(function(){
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/destroy', 'destroy')->name('destroy');
            });
            Route::controller(TypeController::class)
            ->as('type.')
            ->prefix('type')
            ->group(function(){
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/destroy', 'destroy')->name('destroy');
            });
        });
        Route::controller(UserAccountController::class)
        ->as('user.')
        ->prefix('user')
        ->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create/{id}', 'create')->name('create');
            Route::post('/store/{id}', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/destroy', 'destroy')->name('destroy');
        });
    });
});
Route::middleware(['auth', 'is_client'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/user/cart/list', [CartController::class, 'listCart'])->name('cart.list');
    Route::post('/user/cart/add/{vehicle_id}/{owner_id}', [CartController::class, 'addCart'])->name('add.cart');
    Route::post('/user/booking/add/{vehicle_id}/{owner_id}', [CartController::class, 'addBooking'])->name('add.booking');
});
Auth::routes();
