<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ObatController;

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
    Route::get('/Admin/Obat', [HomeController::class, 'admin'])->name('admin.home');
});

// superuser dashboard
Route::middleware(['auth', 'user-access:Super Admin'])->group(function () { 
    Route::get('/SuperAdmin/Dashboard', [HomeController::class, 'super'])->name('super.superhome');
});

Route::prefix('Admin/Obat')->middleware(['auth', 'user-access:Admin'])->group(function () {
    Route::get('/', [ObatController::class, 'indexAdmin'])->name('adminobat.index');
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