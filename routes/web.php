<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;





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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('anggaran', AnggaranController::class);

Route::resource('pengeluaran', PengeluaranController::class);

Route::resource('admin', AdminController::class);

Route::resource('report', ReportController::class);
Route::get('/report/create', [ReportController::class, 'create'])->name('report.create');
Route::post('/report', [ReportController::class, 'store'])->name('report.store');
Route::get('/pengeluaran/{id}/edit', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



