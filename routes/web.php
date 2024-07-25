<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('reserves/json', [ReserveController::class, 'json']);
Route::resource('reservas', ReserveController::class)->names('reserves')->parameters([
    'reservas' => 'reserve',
]);

Route::get('errors', function() {
    return view('errors.503');
});
Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

Route::get('/dev/login', DevController::class)->name('dev.login');
Route::resource('/dashboard', DashboardController::class)->only('index')->names('dashboard')->middleware([
    'auth', 'verified',
]);
Route::middleware('auth')->group(function() {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('itens-locacao', RentalItemController::class)->names('rental-items')->parameters([
        'itens-locacao' => 'rental-item',
    ]);
    Route::resource('usuarios', UserController::class)->names('users')->parameters([
        'usuarios' => 'user',
    ]);
    Route::get('/pdf', [ReportsController::class, 'generatePdf'])->name('pdf.reports');
    Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::resource('relatorios', ReportsController::class)->names('reports')->parameters([
        'relatorios' => 'report',
    ]);
    Route::get('/reservas/search', [ReserveController::class, 'search'])->name('reservas.search');
});

require __DIR__ . '/auth.php';
