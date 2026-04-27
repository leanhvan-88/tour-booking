<?php

use Illuminate\Support\Facades\Route;



// ================= ADMIN =================
use App\Http\Controllers\Admin\TourController as AdminTourController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\TourController;
use App\Http\Controllers\User\BookingController;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('user.about');
})->name('about');
Route::get('/contact', function () {
    return view('user.contact');
})->name('contact');
// Tour
Route::prefix('tours')->group(function () {
    Route::get('/', [TourController::class, 'index'])->name('tours.index');
    Route::get('/{id}', [TourController::class, 'show'])->name('tours.show');
});
// Booking
Route::get('/booking/{id}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Optional
Route::get('/my-bookings', [BookingController::class, 'index'])->name('booking.index');
Route::get('/booking/{id}/view', [BookingController::class, 'show'])->name('booking.show');
Route::post('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
// ================= FRONTEND =================

// Trang chủ (list tour)

// ================= ADMIN =================
// LOGIN ADMIN
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('tours', AdminTourController::class)->except([
        'create', 'edit'
    ]);

    
});
Route::prefix('admin')->group(function () {

    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');

    Route::get('/bookings/{id}', [AdminBookingController::class, 'show'])->name('admin.bookings.show');

    Route::post('/bookings/{id}/update', [AdminBookingController::class, 'update'])->name('admin.bookings.update');

    Route::post('/bookings/{id}/delete', [AdminBookingController::class, 'destroy'])->name('admin.bookings.delete');

});