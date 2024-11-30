<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function (){
    return view('dashboard');
});

Route::resource('anggaran', AnggaranController::class);
Route::resource('pengeluaran', PengeluaranController::class);
Route::resource('admin', AdminController::class);
Route::resource('report', ReportController::class);
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
