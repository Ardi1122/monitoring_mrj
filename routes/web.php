<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PregnancyLogController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('main');
});
Route::get('/', [TestimoniController::class, 'index'])->name('main');

Route::prefix('ibu-hamil')
    ->name('ibu_hamil.')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/dashboard', [MonitoringController::class, 'index'])->name('dashboard');
        Route::get('/education', [EducationController::class, 'index'])->name('education');
        Route::get('/monitoring', [MonitoringController::class, 'monitoring'])->name('monitoring');
        Route::patch('/reminders/{reminder}/complete', [MonitoringController::class, 'completeReminder'])
            ->name('reminders.complete');

        Route::post('/monitoring', [MonitoringController::class, 'store'])->name('monitoring.store');
        Route::get('/monitoring/{monitoring}/edit', [MonitoringController::class, 'edit'])->name('monitoring.edit');
        Route::put('/monitoring/{monitoring}', [MonitoringController::class, 'update'])->name('monitoring.update');
        Route::delete('/monitoring/{monitoring}', [MonitoringController::class, 'destroy'])->name('monitoring.destroy');

        Route::post('/mrj-tracker', [MonitoringController::class, 'storeMRJ'])->name('mrj.store');
        Route::get('/setting', [UserController::class, 'showProfile'])->name('setting');

        Route::get('/pregnancy-log', [PregnancyLogController::class, 'index'])->name('log');
        Route::post('/pregnancy-log', [PregnancyLogController::class, 'store'])->name('log.store');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
