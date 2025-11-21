<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
Route::get('/', function () {
    $title = 'Selamat Datang';
    $slug = 'welcome';
    return view('konten.welcome', compact('title', 'slug'));
});
Route::get('/daftar', [PenggunaController::class, 'create'])
     ->name('daftar');

// terima submit form
Route::post('/daftar', [PenggunaController::class, 'store']);

// login
Route::get ('/login',  [LoginController::class, 'create'])->name('login');
Route::post('/login',  [LoginController::class, 'store']);

// logout (opsional, bisa POST via form)
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware('auth:pengguna')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::middleware('auth:pengguna')->group(function () {
Route::get('/notification', [NotificationController::class, 'index']);
} );

Route::get('/daftarJadwal',function(){
    return view('konten.daftarJadwal');
})->name('daftarJadwal');