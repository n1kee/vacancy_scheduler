<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacationController;
use App\Http\Middleware\EnsureCanEditVacation;
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
    return redirect()->route('vacation.list');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/vacation', [VacationController::class, 'list'])->name('vacation.list');
    Route::middleware(EnsureCanEditVacation::class)->group(function () {
        Route::get('/vacation/new', [VacationController::class, 'edit'])->name('vacation.new');
        Route::get('/vacation/{id}', [VacationController::class, 'edit'])->name('vacation.edit');
        Route::patch('/vacation/{id?}', [VacationController::class, 'update'])->name('vacation.update');
    });
    Route::get('/vacation/{id?}/approve', [VacationController::class, 'approve'])->name('vacation.approve');
    Route::delete('/vacation/{id}', [VacationController::class, 'destroy'])->name('vacation.destroy');
});

require __DIR__.'/auth.php';
