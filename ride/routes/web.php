<?php

use App\Http\Controllers\Car\CarsController;
use App\Http\Controllers\LGAsAndSatesController;
use App\Http\Controllers\Rides\RideController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth')->group(function () {

    Route::group(['prefix' => 'cars'], function () {

        Route::get('upload', [CarsController::class, 'create'])->name('cars.upload');

        Route::post('store', [CarsController::class, 'store'])->name('cars.store');
    });
});

Route::group(['prefix' => 'ride'], function () {

    Route::get('rent', [RideController::class, 'rent'])->name('rides.rent');

    Route::post('store', [CarsController::class, 'store'])->name('cars.store');

    Route::post('search', [RideController::class, 'search'])->name('cars.search');

    Route::get('search/result', [RideController::class, 'result'])->name('search.result');

    Route::post('selected/items', [RideController::class, 'viewDetailsOfTheSelecedItems'])->name('selected.items');

    Route::get('selected/checkout', [RideController::class, 'selectedCheckoutPage'])->name('selected.checkout');

    Route::post('checkout', [RideController::class, 'checkout'])->name('ride.checkout');
});


Route::get('get/lgas/{state_id}', [LGAsAndSatesController::class, 'getLgas']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');