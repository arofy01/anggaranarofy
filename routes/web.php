<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminProfileController;

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

// Routes untuk autentikasi admin
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Routes untuk registrasi admin
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Routes yang memerlukan autentikasi admin
Route::middleware(['auth:admin'])->group(function () {
    // Profil admin
    Route::get('profile', [AdminProfileController::class, 'show'])->name('admin.profile');
    Route::put('profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::put('profile/password', [AdminProfileController::class, 'updatePassword'])->name('admin.profile.password');
    
    // Dashboard dan route lainnya
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/', [DashboardController::class, 'index']);
    
    // Resources
    Route::resource('anggaran', AnggaranController::class);
    Route::resource('pengeluaran', PengeluaranController::class);
    Route::resource('admin', AdminController::class);
    
    // Report routes - specific routes first
    Route::get('/report/export-pdf', [ReportController::class, 'exportPDF'])->name('report.exportPDF');
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/report/{id}', [ReportController::class, 'show'])->name('report.show');

    // Pengeluaran routes
    Route::get('/pengeluaran/{id}/edit', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
    Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
});
