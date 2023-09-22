<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PenjualanController;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->Admin()) {
            return redirect()->route('admin.adminhome');
        } elseif (Auth::user()->Super()) {
            return redirect()->route('super.superhome');
        }
    }
    return redirect()->route('login');
});

Route::get('logout', function () {
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

Auth::routes();

// auth admin
Route::middleware(['auth', 'user-access:Admin'])->group(function () {
    Route::get('/Admin', [HomeController::class, 'admin'])->name('admin.dashboard');
});

// superuser dashboard
Route::middleware(['auth', 'user-access:Super Admin'])->group(function () {
    Route::get('/SuperAdmin/Dashboard', [HomeController::class, 'super'])->name('super.superhome');
});

Route::prefix('Admin/Obat')->middleware(['auth', 'user-access:Admin'])->group(function () {
    Route::get('/', [ObatController::class, 'indexAdmin'])->name('admin.dashboard');
    Route::get('/add', [ObatController::class, 'create'])->name('adminobat.create');
    Route::post('/store', [ObatController::class, 'store'])->name('adminobat.store');
});

Route::prefix('SuperAdmin/Obat')->middleware(['auth', 'user-access:Super Admin'])->group(function () {
    Route::get('/', [ObatController::class, 'indexSuper'])->name('super.superobat');
    Route::get('/add', [ObatController::class, 'create'])->name('super.create');
    Route::post('/store', [ObatController::class, 'store'])->name('super.store');
    Route::get('/edit/{obat}', [ObatController::class, 'edit'])->name('super.edit');
    Route::put('/update/{obat}', [ObatController::class, 'update'])->name('super.update');
    Route::delete('/destroy/{obat}', [ObatController::class, 'destroy'])->name('super.destroy');
});


// Penjualan
Route::prefix('Laporan')->middleware(['auth', 'user-access:Super Admin, Admin'])->group(function () {
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('laporan.index');
    Route::get('/penjualan/{penjualan}', [PenjualanController::class, 'show'])->name('laporan.show');
    Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('laporan.create');
    Route::post('/penjualan', [PenjualanController::class, 'store'])->name('laporan.store');
    Route::get('/penjualan/{penjualan}/edit', [PenjualanController::class, 'edit'])->name('laporan.edit');
    Route::put('/penjualan/{penjualan}', [PenjualanController::class, 'update'])->name('laporan.update');
    Route::delete('/penjualan/{penjualan}', [PenjualanController::class, 'destroy'])->name('laporan.destroy');
});
