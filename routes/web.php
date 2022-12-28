<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BataliyonController;
use App\Http\Controllers\DistribusiBarangController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemStockController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServisBarangController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::prefix("auth")->group(function () {
    // View
    Route::get("/login", [AuthController::class, "loginForm"])->middleware('guest');
    Route::get("/register", [AuthController::class, "registrasiForm"])->middleware('guest');
    Route::post("/logout", [AuthController::class, "logout"])->middleware('auth');

    Route::post("/login", [AuthController::class, "login"])->middleware('guest');
    Route::post("/register", [AuthController::class, "register"])->middleware('guest');
    // Logic
});

Route::prefix('admin')->group(function () {
    Route::middleware(['auth', 'isAdmin'])->group(function () {
        Route::get('/', [AdminController::class, 'index']);

        Route::get('/barang', [AdminController::class, 'barang']);
        Route::get('/barang/{id}', [AdminController::class, 'barang']);

        Route::get('/servis-barang', [AdminController::class, 'servisBarang']);
        Route::get('/servis-barang/{id}', [AdminController::class, 'servisBarang']);

        Route::get('/barang-masuk', [AdminController::class, 'barangMasuk']);
        Route::get('/barang-masuk/{id}', [AdminController::class, 'barangMasuk']);

        Route::get('/barang-keluar', [AdminController::class, 'barangKeluar']);
        Route::get('/barang-keluar/{id}', [AdminController::class, 'barangKeluar']);

        Route::get('/stok-barang', [ItemStockController::class, 'index']);
        Route::post('/stok-barang', [ItemStockController::class, 'store']);
        Route::get('/stok-barang/{id}/{periode}/cetak', [ItemStockController::class, 'cetak']);

        Route::get('/pegawai', [AdminController::class, 'pegawai']);
        Route::get('/pegawai/{id}', [AdminController::class, 'pegawai']);

        Route::get('/laporan', [AdminController::class, 'laporan']);
        Route::post('/laporan', [AdminController::class, 'laporan']);
        Route::get('/laporan/{id_laporan}/{id_bulan}/{id_tahun}/cetak', [AdminController::class, 'cetakLaporanBulanan']);

        Route::get('/ganti-password', [AdminController::class, 'gantiPassword']);
        Route::post('/ganti-password', [AuthController::class, 'changePassword']);

        Route::post('/barang', [BarangController::class, 'tambahBarang']);
        Route::post('/barang/{id}', [BarangController::class, 'ubahBarang']);
        Route::get('/barang/hapus/{id}', [BarangController::class, 'hapusBarang']);

        Route::post('/servis-barang', [ServisBarangController::class, 'tambahServisBarang']);
        Route::post('/servis-barang/{id}', [ServisBarangController::class, 'ubahServisBarang']);
        Route::get('/servis-barang/hapus/{id}', [ServisBarangController::class, 'hapusServisBarang']);

        Route::post('/barang-masuk', [DistribusiBarangController::class, 'inputBarangMasuk']);
        Route::post('/barang-masuk/{id}', [DistribusiBarangController::class, 'ubahBarangMasuk']);
        Route::get('/barang-masuk/hapus/{id}', [DistribusiBarangController::class, 'hapusBarangMasuk']);

        Route::post('/barang-keluar', [DistribusiBarangController::class, 'inputBarangKeluar']);
        Route::post('/barang-keluar/{id}', [DistribusiBarangController::class, 'ubahBarangKeluar']);
        Route::get('/barang-keluar/hapus/{id}', [DistribusiBarangController::class, 'hapusBarangKeluar']);

        Route::post('/pegawai', [EmployeeController::class, 'tambah']);
        Route::post('/pegawai/{id}', [EmployeeController::class, 'ubah']);
        Route::get('/pegawai/hapus/{id}', [EmployeeController::class, 'hapus']);
    });

    // Login
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminController::class, 'login'])->name('login');
        Route::post('/login', [AdminController::class, 'authenticate']);
    });
});

Route::prefix('bataliyon')->group(function () {
    Route::get('/', [BataliyonController::class, 'index']);
    Route::get('/upload-file', [BataliyonController::class, 'upload_file']);
    Route::get('/informasi', [BataliyonController::class, 'informasi']);
});
