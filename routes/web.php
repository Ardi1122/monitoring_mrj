<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('main');
});

Route::prefix('ibu-hamil')
    ->name('ibu_hamil.')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('ibu_hamil.dashboard');
        })->name('dashboard');

        Route::get('/education', function () {
            return view('ibu_hamil.education');
        })->name('education');

        Route::get('/monitoring', function () {
            return view('ibu_hamil.monitoring');
        })->name('monitoring');

        Route::get('/mrj-tracker', function () {
            return view('ibu_hamil.mrj');
        })->name('mrj');

        Route::get('/pregnancy-log', function () {
            return view('ibu_hamil.log');
        })->name('log');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

