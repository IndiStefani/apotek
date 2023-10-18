<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\TransaksiController;

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

// transaksi
Route::prefix('Transaksi')->middleware(['auth', 'user-access:Super Admin, Admin'])->group(function () {
    Route::get('/', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/add', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/edit/{Transaksi}', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::put('/update/{Transaksi}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('destroy/{Transaksi}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::post('/simpan-sementara', [TransaksiController::class], 'simpanSementara')->name(('tempData'));
});
