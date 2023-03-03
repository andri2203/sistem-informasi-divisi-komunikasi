<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DistribusiBarangController;
use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FileHandleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\ItemStockController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Profil;
use App\Http\Controllers\ServisBarangController;
use App\Http\Controllers\UploadedFileController;
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

Route::get('/files/{target}/{image}', [FileHandleController::class, 'index']);

Route::get('/download/{id}', [DownloadFileController::class, 'index']);

Route::prefix('dashboard')->group(function () {
    Route::get('/', [Dashboard::class, 'index']);
});

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

        Route::get('/berita', [NewsController::class, 'index']);
        Route::get('/berita/list', [NewsController::class, 'data']);
        Route::get('/berita/{id}', [NewsController::class, 'index']);
        Route::get('/berita/hapus/{id}', [NewsController::class, 'hapus']);
        Route::post('/berita', [NewsController::class, 'tambah']);
        Route::post('/berita/{id}', [NewsController::class, 'ubah']);

        Route::get('/file', [AdminController::class, 'file']);
        Route::post('/file', [AdminController::class, 'file']);
    });

    // Login
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminController::class, 'login'])->name('login');
        Route::post('/login', [AdminController::class, 'authenticate']);
    });
});

Route::prefix('manage')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/user', [ManageUserController::class, 'form']);
    Route::get('/user/{id}', [ManageUserController::class, 'form']);
    Route::get('/user-list', [ManageUserController::class, 'list']);

    Route::post('/user', [ManageUserController::class, 'manage']);
    Route::get('/user/hapus/{id}', [ManageUserController::class, 'deleteAccess']);

    Route::get('/pegawai', [ManageUserController::class, 'pegawai']);
    Route::get('/pegawai/{id}', [ManageUserController::class, 'pegawai']);
    Route::post('/pegawai', [EmployeeController::class, 'tambah']);
    Route::post('/pegawai/{id}', [EmployeeController::class, 'ubah']);
    Route::get('/pegawai/hapus/{id}', [EmployeeController::class, 'hapus']);
});

Route::prefix('profil')->middleware('auth')->group(function () {
    Route::get('/', [Profil::class, 'index']);
    Route::get('/ganti-password', [Profil::class, 'gantiPassword']);
    Route::post('/ganti-password', [AuthController::class, 'changePassword']);
    Route::post('/tambah-profil', [Profil::class, 'tambah_profil']);
    Route::post('/ubah-profil/{id}', [Profil::class, 'ubah_profil']);
    Route::post('/ubah-foto/{id}', [Profil::class, 'ubah_foto']);
});

Route::prefix('upload_file')->middleware('auth')->group(function () {
    Route::get('/', [UploadedFileController::class, 'index']);
    Route::get('/tambah', [UploadedFileController::class, 'form']);
    Route::get('/edit/{id}', [UploadedFileController::class, 'form']);
    Route::post('/tambah', [UploadedFileController::class, 'upload']);
    Route::post('/edit/{id}', [UploadedFileController::class, 'update']);
    Route::get('/hapus/{id}', [UploadedFileController::class, 'delete']);
});

Route::prefix('informasi')->middleware('auth')->group(function () {
    Route::get('/', [InformationController::class, 'index']);
    Route::post('/show', [InformationController::class, 'show']);
    Route::get('/{id_laporan}/{id_bulan}/{id_tahun}/cetak', [InformationController::class, 'cetak']);
});

Route::prefix('pengumuman')->middleware('auth')->group(function () {
    Route::get('/', [NewsController::class, 'dashboard_pengumuman']);
});

Route::prefix('berita')->group(function () {
    Route::get('/baca/{slug}', [NewsController::class, 'berita']);
    Route::get('/pengumuman', [NewsController::class, 'home_pengumuman']);
});
