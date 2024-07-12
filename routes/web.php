<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('welcome');
});

Route::get('/pdf', [ReportsController::class, 'generatePdf'])->name('pdf.reports');

Route::resource('/dashboard', DashboardController::class)->only('index')->names('dashboard')->middleware([
    'auth', 'verified',
]);

Route::middleware('auth')->group(function() {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('rental-items', RentalItemController::class);
    Route::resource('users', UserController::class);
    Route::get('reserves/json', [ReserveController::class, 'json']);
    Route::resource('reserves', ReserveController::class)->names('reserves')->parameters([
        'reserves' => 'reserve'
    ]);
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('reports', ReportsController::class);
    Route::get('/reservas/search', [ReserveController::class, 'search'])->name('reservas.search');
});

require __DIR__ . '/auth.php';
