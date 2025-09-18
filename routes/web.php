<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\UserController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Semua route web aplikasi masuk di sini
|
*/

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// Auth bawaan Laravel
Auth::routes();


//logout
Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Default setelah login (kalau bukan admin/guru/kepsek)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ================== DASHBOARD SESUAI ROLE ================== //
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth');

  Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    });


Route::get('/guru/dashboard', function () {
    return view('guru.dashboard');
})->middleware('auth');

Route::prefix('guru')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('guru.dashboard');
    });

Route::get('/kepsek/dashboard', function () {
    return view('kepsek.dashboard');
})->middleware('auth');

Route::prefix('kepsek')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('kepsek.dashboard');
    });

//admin
Route::prefix('admin')->name('admin.')->group(function() {
        Route::resource('data_guru', GuruController::class);
    });

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('data_mapel', MapelController::class);
    });
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('data_kelas', KelasController::class);
    });

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    });

Route::prefix('admin')->name('admin.')->group(function () {
    // CETAK PDF (didefinisikan sebelum resource)
    Route::get('kelola_jadwal/cetakPdf', [JadwalController::class, 'cetakPdf'])
        ->name('kelola_jadwal.cetakPdf');

    // Resource
    Route::resource('kelola_jadwal', JadwalController::class);
});



//guru
 Route::prefix('guru')->name('guru.')->group(function() {
    Route::get('/data_guru', [GuruController::class, 'indexGuru'])->name('data_guru');
    });

 Route::prefix('guru')->name('guru.')->group(function () {
    Route::get('/data_kelas', [KelasController::class, 'indexKelas'])->name('data_kelas');
    });

Route::prefix('guru')->name('guru.')->group(function () {
    Route::get('/data_mapel', [MapelController::class, 'indexmapel'])->name('data_mapel');
    });
Route::prefix('guru')->name('guru.')->group(function () {
    // CETAK PDF (didefinisikan sebelum resource)
    Route::get('kelola_jadwal/cetakPdf', [JadwalController::class, 'cetakPdf'])
        ->name('kelola_jadwal.cetakPdf');

    // Resource
    Route::resource('kelola_jadwal', JadwalController::class);
});

//kepsek
Route::prefix('kepsek')->name('kepsek.')->group(function() {
    Route::get('/data_guru', [GuruController::class, 'indexGuru'])->name('data_guru');
    });

Route::prefix('kepsek')->name('kepsek.')->group(function() {
    Route::get('/data_kelas', [KelasController::class, 'indexKelas'])->name('data_kelas');
    });

Route::prefix('kepsek')->name('kepsek.')->group(function() {
    Route::get('/data_mapel', [MapelController::class, 'indexMapel'])->name('data_mapel');
    });

Route::prefix('kepsek')->name('kepsek.')->group(function () {
    // CETAK PDF (didefinisikan sebelum resource)
    Route::get('kelola_jadwal/cetakPdf', [JadwalController::class, 'cetakPdf'])
        ->name('kelola_jadwal.cetakPdf');

    // Resource
    Route::resource('kelola_jadwal', JadwalController::class);
});