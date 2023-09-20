<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FiturController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SolusiController;
use App\Http\Controllers\ManfaatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\DetailSectionController;

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
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('kelola-section/datatable', [SectionController::class, 'datatable'])->name('kelola-section.datatable');
    Route::resource('kelola-section', SectionController::class);

    Route::get('kelola-detail/datatable', [DetailSectionController::class, 'datatable'])->name('kelola-detail.datatable');
    Route::resource('kelola-detail', DetailSectionController::class);

    Route::get("/logout", [LoginController::class, 'logout']);
});

require __DIR__.'/auth.php';
