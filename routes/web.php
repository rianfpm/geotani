<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KomoditasController;
use App\Http\Controllers\RekomendasiController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/belanja', [ProdukController::class, 'index']);
Route::get('/video', [VideoController::class, 'index']);
Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/tentang-kami', [HomeController::class, 'tentangkami']);

Route::get('/storage-link', function () {
    $targetfolder = storage_path('app/public');
    $linkfolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetfolder, $linkfolder);
});

Route::get('/detail-produk/{id}', [ProdukController::class, 'detailproduk']);
Route::get('/detail-video/{id}', [VideoController::class, 'detailvideo']);
Route::get('/detail-artikel/{id}', [ArtikelController::class, 'detailartikel']);
Route::get('/detail-rekomendasi/{id}', [RekomendasiController::class, 'detailrekomendasi']);

Route::get('/login', [HomeController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [HomeController::class, 'authenticate']);
Route::get('/signup', [HomeController::class, 'register'])->middleware('guest');
Route::post('/signup', [HomeController::class, 'store']);
Route::post('/logout', [HomeController::class, 'logout']);

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard']);

    Route::get('/dashboard/data-artikel', [ArtikelController::class, 'dataartikel']);
    Route::get('/dashboard/tambah-data-artikel', [ArtikelController::class, 'tambahdataartikel']);
    Route::post('/dashboard/tambah-data-artikel', [ArtikelController::class, 'store']);
    Route::patch('/dashboard/data-artikel/{id}', [ArtikelController::class, 'editdataartikel']);
    Route::get('/dashboard/data-artikel/edit/{id}', [ArtikelController::class, 'edit']);
    Route::delete('/dashboard/data-artikel/{artikel:id}', [ArtikelController::class, 'delete']);

    Route::get('/dashboard/data-video', [VideoController::class, 'datavideo']);
    Route::get('/dashboard/tambah-data-video', [VideoController::class, 'tambahdatavideo']);
    Route::post('/dashboard/tambah-data-video', [VideoController::class, 'store']);
    Route::get('/dashboard/data-video/edit/{id}', [VideoController::class, 'edit']);
    Route::put('/dashboard/data-video/{id}', [VideoController::class, 'editdatavideo']);
    Route::delete('/dashboard/data-video/{video:id}', [VideoController::class, 'delete']);

    Route::get('/dashboard/data-produk', [ProdukController::class, 'dataproduk']);
    Route::get('/dashboard/tambah-data-produk', [ProdukController::class, 'tambahdataproduk']);
    Route::post('/dashboard/tambah-data-produk', [ProdukController::class, 'store']);
    Route::get('/dashboard/data-produk/edit/{id}', [ProdukController::class, 'edit']);
    Route::put('/dashboard/data-produk/{id}', [ProdukController::class, 'editdataproduk']);
    Route::delete('/dashboard/data-produk/{produk:id}', [ProdukController::class, 'delete']);

    Route::get('/dashboard/data-kategori', [KategoriController::class, 'datakategori']);
    Route::get('/dashboard/tambah-data-kategori', [KategoriController::class, 'tambahdatakategori']);
    Route::post('/dashboard/tambah-data-kategori', [KategoriController::class, 'store']);
    Route::get('/dashboard/data-kategori/edit/{id}', [KategoriController::class, 'edit']);
    Route::put('/dashboard/data-kategori/{id}', [KategoriController::class, 'editdatakategori']);
    Route::delete('/dashboard/data-kategori/{kategori:id}', [KategoriController::class, 'delete']);

    Route::get('/dashboard/data-komoditas', [KomoditasController::class, 'datakomoditas']);
    Route::get('/dashboard/tambah-data-komoditas', [KomoditasController::class, 'tambahdatakomoditas']);
    Route::post('/dashboard/tambah-data-komoditas', [KomoditasController::class, 'store']);
    Route::patch('/dashboard/data-komoditas/{id}', [KomoditasController::class, 'editdatakomoditas']);
    Route::get('/dashboard/data-komoditas/edit/{id}', [KomoditasController::class, 'edit']);
    Route::delete('/dashboard/data-komoditas/{komoditas:id}', [KomoditasController::class, 'delete']);

    Route::get('/dashboard/data-rekomendasi', [RekomendasiController::class, 'datarekomendasi']);
    Route::get('/dashboard/tambah-data-rekomendasi', [RekomendasiController::class, 'tambahdatarekomendasi']);
    Route::post('/dashboard/tambah-data-rekomendasi', [RekomendasiController::class, 'store']);
    Route::patch('/dashboard/data-rekomendasi/{id}', [RekomendasiController::class, 'editdatarekomendasi']);
    Route::get('/dashboard/data-rekomendasi/edit/{id}', [RekomendasiController::class, 'edit']);
    Route::delete('/dashboard/data-rekomendasi/{rekomendasi:id}', [RekomendasiController::class, 'delete']);
    Route::get('/dashboard/restore', [RekomendasiController::class, 'restore']);
});