<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;

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

// Guest Routes (Autentikasi)
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated Routes (Semua yang login)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout']);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Quick Search API
    Route::get('/api/quick-search', [BarangController::class, 'quickSearch'])->name('api.quick-search');

    // 1. Modul Data Barang
    Route::middleware('role:administrator,staff_gudang,pimpinan')->group(function () {
        Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
        Route::get('/barang/{barang}', [BarangController::class, 'show'])->name('barang.show');
    });
    Route::middleware('role:administrator,staff_gudang')->group(function () {
        Route::get('/barang/create/form', [BarangController::class, 'create'])->name('barang.create');
        Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
        Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
        Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
    });
    Route::middleware('role:administrator')->group(function () {
        Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
    });

    // 2. Modul Data Kategori
    Route::middleware('role:administrator,staff_gudang,pimpinan')->group(function () {
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    });
    Route::middleware('role:administrator')->group(function () {
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });

    // 3. Modul Data Supplier
    Route::middleware('role:administrator,staff_gudang,pimpinan')->group(function () {
        Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
        Route::get('/supplier/{supplier}', [SupplierController::class, 'show'])->name('supplier.show');
    });
    Route::middleware('role:administrator')->group(function () {
        Route::get('/supplier/create/form', [SupplierController::class, 'create'])->name('supplier.create');
        Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/supplier/{supplier}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::put('/supplier/{supplier}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::delete('/supplier/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
    });

    // 4. Modul Barang Masuk
    Route::middleware('role:administrator,staff_gudang,pimpinan')->group(function () {
        Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
    });
    Route::middleware('role:administrator,staff_gudang')->group(function () {
        Route::get('/barang-masuk/create/form', [BarangMasukController::class, 'create'])->name('barang-masuk.create');
        Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barang-masuk.store');
    });

    // 5. Modul Barang Keluar
    Route::middleware('role:administrator,staff_gudang,pimpinan')->group(function () {
        Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar.index');
    });
    Route::middleware('role:administrator,staff_gudang')->group(function () {
        Route::get('/barang-keluar/create/form', [BarangKeluarController::class, 'create'])->name('barang-keluar.create');
        Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('barang-keluar.store');
    });

    // 6. Modul Mutasi Barang
    Route::middleware('role:administrator,staff_gudang,pimpinan')->group(function () {
        Route::get('/mutasi', [MutasiController::class, 'index'])->name('mutasi.index');
    });
    Route::middleware('role:administrator,staff_gudang')->group(function () {
        Route::get('/mutasi/create/form', [MutasiController::class, 'create'])->name('mutasi.create');
        Route::post('/mutasi', [MutasiController::class, 'store'])->name('mutasi.store');
    });

    // 7. Modul Peminjaman Barang
    Route::middleware('role:administrator,staff_gudang,pimpinan')->group(function () {
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    });
    Route::middleware('role:administrator,staff_gudang')->group(function () {
        Route::get('/peminjaman/create/form', [PeminjamanController::class, 'create'])->name('peminjaman.create');
        Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    });

    // 8. Modul Pengembalian Barang
    Route::middleware('role:administrator,staff_gudang')->group(function () {
        Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
    });

    // 9. Modul Data Pengguna (Admin only)
    Route::middleware('role:administrator')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });

    // 10. Modul Laporan Inventori
    Route::middleware('role:administrator,pimpinan')->group(function () {
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
        Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
    });
});
