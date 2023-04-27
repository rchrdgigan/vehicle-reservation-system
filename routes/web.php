<?php

use App\Http\Controllers\{
    HomeController,
    PageController,
    VehicleController,
    BrandController,
    TypeController,
    UserAccountController,
    CartController,
    ProfileController,
    OwnerController,
    BookingController,
    CustomerController,
    ContactController,
};
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'welcome'])->name('welcome');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/vehicle/list/all', [PageController::class, 'vehicleList'])->name('vehicle.list');

Route::get('/about', [PageController::class, 'about'])->name('about');

  Route::controller(ContactController::class)
            ->as('contact.')
            ->prefix('contact')
            ->group(function(){
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
            });
Route::get('/vehicle/list/search', [PageController::class, 'vehicleList'])->name('vehicle.search');
Route::get('/vehicle/list/brand/{brand}', [PageController::class, 'vehicleFilteredBrand'])->name('vehicle.filter.brand');
Route::get('/vehicle/list/type/{type}', [PageController::class, 'vehicleFilteredType'])->name('vehicle.filter.type');
Route::get('/vehicle/details/{id}', [PageController::class, 'vehicleDetail'])->name('vehicle.details');
Route::get('/owner/vehicle-list/{id}', [PageController::class, 'ownerCars'])->name('owner.car');
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
        Route::get('/', [HomeController::class, 'adminHome'])->name('index');
        Route::get('/profile', [ProfileController::class, 'showProfile'])->name('show.profile');
        Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('update.profile');
        Route::put('/password/update', [ProfileController::class, 'updatePassword'])->name('update.password');
        Route::get('/booking/history', [BookingController::class, 'historyBookingList'])->name('history.booking.list');
        Route::controller(VehicleController::class)
        ->as('vehicle.')
        ->prefix('vehicle')
        ->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/expired', 'expired')->name('expired');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/destroy', 'destroy')->name('destroy');
            Route::get('/update/info/{id}', 'approvedVehicle')->name('aproved');
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
        Route::controller(ContactController::class)
            ->as('contact.')
            ->prefix('contact')
            ->group(function(){
                Route::get('/list', 'list')->name('list');
                Route::delete('/destroy', 'destroy')->name('destroy');
            });
    });
});
Route::middleware(['auth', 'is_client'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/user/cart/list', [CartController::class, 'listCart'])->name('cart.list');
    Route::get('/user/cart/add/{vehicle_id}/{owner_id}', [CartController::class, 'addCart'])->name('add.cart');
    Route::delete('/user/cart/remove', [CartController::class, 'removeCart'])->name('remove.cart');
    Route::put('/user/update', [ProfileController::class, 'updateProfile'])->name('update.user');
    Route::put('/user/password/update', [ProfileController::class, 'updatePassword'])->name('update.password');
    Route::post('/owner/store',[OwnerController::class, 'store'])->name('owner.store');
    Route::put('/owner/update',[OwnerController::class, 'update'])->name('owner.update');
    Route::get('/user/booking/pending', [BookingController::class, 'index'])->name('pending.booking');
    Route::get('/user/booking/add/{vehicle_id}/{owner_id}', [BookingController::class, 'addBooking'])->name('add.booking');
    Route::post('/user/booking/add', [BookingController::class, 'addBookingModal'])->name('add.booking.modal');
    Route::get('/user/booking/add/cart/{id}/{vehicle_id}/{owner_id}', [BookingController::class, 'addBookingFromCart'])->name('add.booking.cart');
    Route::get('/user/booking/cancel', [BookingController::class, 'cancelledBookingList'])->name('cancelled.booking.list');
    Route::put('/user/booking/cancel', [BookingController::class, 'cancelledBooking'])->name('cancel.booking');
    Route::get('/user/booking/history', [BookingController::class, 'historyBookingList'])->name('history.booking.list');
    Route::get('/user/booking/approved', [BookingController::class, 'approveBookingList'])->name('approved.booking.list');
    Route::get('/user/booking/done', [BookingController::class, 'doneBookingList'])->name('done.booking.list');
    Route::get('/user/vehicle/index', [VehicleController::class, 'vehicleList'])->name('vehicle.index');
    Route::get('/user/vehicle/create', [VehicleController::class, 'vehicleCreate'])->name('vehicle.create');
    Route::post('/user/vehicle/store', [VehicleController::class, 'vehicleStore'])->name('vehicle.store');
    Route::get('/user/vehicle/show/{id}', [VehicleController::class, 'vehicleShow'])->name('vehicle.show');
    Route::get('/user/vehicle/edit/{id}', [VehicleController::class, 'vehicleEdit'])->name('vehicle.edit');
    Route::delete('/user/vehicle/destroy', [VehicleController::class, 'destroy'])->name('vehicle.destroy');
    Route::put('/user/vehicle/update/{id}', [VehicleController::class, 'vehicleUpdate'])->name('vehicle.update');
    Route::get('/user/vehicle/expired', [VehicleController::class, 'vehicleExpired'])->name('vehicle.expired');
    Route::get('/user/customer/index', [CustomerController::class, 'index'])->name('owner.index');
    Route::get('/user/customer/cancel', [CustomerController::class, 'cancelledCustomerList'])->name('cancel.customer.list');
    Route::put('/user/customer/cancel', [CustomerController::class, 'cancelledCustomer'])->name('cancel.customer');
    Route::get('/user/customer/approved', [CustomerController::class, 'approvedCustomerList'])->name('approved.customer.list');
    Route::put('/user/customer/approved', [CustomerController::class, 'approvedCustomer'])->name('approved.customer');
    Route::get('/user/customer/done', [CustomerController::class, 'doneCustomerList'])->name('done.customer.list');
    Route::put('/user/customer/done', [CustomerController::class, 'doneCustomer'])->name('done.customer');
});
Auth::routes();
