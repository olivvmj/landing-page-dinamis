<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TentangController;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('kelola-tentang/datatable', [TentangController::class, 'datatable'])->name('kelola-tentang.datatable');
    Route::resource('kelola-tentang', TentangController::class);

    Route::get('kelola-solusi/datatable', [SolusiController::class, 'datatable'])->name('kelola-solusi.datatable');
    Route::resource('kelola-solusi', SolusiController::class);

    Route::get('kelola-manfaat/datatable', [ManfaatController::class, 'datatable'])->name('kelola-manfaat.datatable');
    Route::resource('kelola-manfaat', ManfaatController::class);

    Route::get('kelola-fitur/datatable', [FiturController::class, 'datatable'])->name('kelola-fitur.datatable');
    Route::resource('kelola-fitur', FiturController::class);

    Route::get("/logout", [LoginController::class, 'logout']);
});

require __DIR__.'/auth.php';
