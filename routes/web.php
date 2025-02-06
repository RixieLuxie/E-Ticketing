<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlaneController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SeatController;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Payment;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'landingpage'])->name('home');
Route::get('/filter', [HomeController::class, 'filter'])->name('home.filter');

// Auth User & Admin
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::resource('/booking', BookingController::class)->only(['index', 'store', 'update', 'destroy'])->middleware(['auth']);
Route::get('/booking/filter', [BookingController::class, 'filter'])->name('booking.filter')->middleware(['auth']);

// Auth Admin
Route::resource('/schedule', ScheduleController::class)->only(['index', 'store', 'update', 'destroy'])->middleware(['Admin']);
Route::resource('/plane', PlaneController::class)->only(['index', 'store', 'update', 'destroy'])->middleware(['Admin']);
Route::resource('/airline', AirlineController::class)->only(['index', 'store', 'update', 'destroy'])->middleware(['Admin']);
Route::resource('/seat', SeatController::class)->only(['index', 'store', 'update', 'destroy'])->middleware(['Admin']);
Route::resource('/airport', AirportController::class)->only(['index', 'store', 'update', 'destroy'])->middleware(['Admin']);
Route::resource('/payment', PaymentController::class)->only(['index', 'store', 'update', 'destroy'])->middleware(['Admin']);
Route::put('/booking/{booking}/approve', [BookingController::class, 'approve'])->name('booking.approve')->middleware(['Admin']);
Route::put('/booking/{booking}/decline', [BookingController::class, 'decline'])->name('booking.decline')->middleware(['Admin']);
Route::get('/booking/preview/{booking_id}', [BookingController::class, 'preview'])->name('booking.preview')->middleware(['Admin']);

// Auth User
Route::resource('/order', OrderController::class)->only(['index', 'store', 'update', 'destroy'])->except(['create'])->middleware(['auth', 'User']);
Route::get('/order/create/{schedule_id}', [OrderController::class, 'create'])->name('order.create.front')->middleware(['auth', 'User']);
Route::get('/order/create', [OrderController::class, 'create'])->name('order.create')->middleware(['auth', 'User']);
Route::get('/order/filter', [OrderController::class, 'filter'])->name('order.filter')->middleware(['auth', 'User']);


// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
