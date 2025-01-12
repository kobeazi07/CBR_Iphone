<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware groWup. Make something great!
|
*/
Route::get('/', [DashboardController::class, 'halaman_prediksi'])->name('HalamanPredict');
Route::get('/login',[DashboardController::class, 'halamanlogin'])->name('HalamanLogin');
Route::post('/logout',[DashboardController::class, 'user_logout'])->name('Logout');
Route::post('/ceklogin',[DashboardController::class, 'ceklogin'])->name('CekLogin');
Route::post('/predict', [DashboardController::class, 'predict'])->name('Predict');

Route::middleware(['auth', 'role:Admin'])->group(function () {
Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('Dashboard');
Route::get('/jenis',[DashboardController::class, 'halamanjenis'])->name('HalamanJenis');
Route::post('/tambah_jenis', [DashboardController::class, 'admin_tambah_jenis'])->name('AdminTambahjenis');
Route::post('/editjenis{id}',[DashboardController::class, 'admin_edit_jenis'])->name('AdminEditjenis');
Route::delete('/jenis/{id}', [DashboardController::class, 'jenis_destroy'])->name('jenis.destroy');

Route::get('/ciri-ciri',[DashboardController::class, 'halamanciri'])->name('HalamanCiri');
Route::post('/tambah_ciri', [DashboardController::class, 'admin_tambah_ciri'])->name('AdminTambahciri');
Route::post('/editciri{id}',[DashboardController::class, 'admin_edit_ciri'])->name('AdminEditciri');
Route::delete('/ciri/{id}', [DashboardController::class, 'ciri_destroy'])->name('ciri.destroy');





Route::get('/gejala',[DashboardController::class, 'halamangejala'])->name('HalamanGejala');
Route::post('/tambah_gejala', [DashboardController::class, 'admin_tambah_gejala'])->name('AdminTambahgejala');
Route::post('/editgejala{id}',[DashboardController::class, 'admin_edit_gejala'])->name('AdminEditgejala');
Route::delete('/gejala/{id}', [DashboardController::class, 'gejala_destroy'])->name('gejala.destroy');

// Route::get('/Gejala',[DashboardController::class, 'halamanjenis'])->name('HalamanJenis');
// Route::post('/tambah_jenis',[DashboardController::class, 'admin_tambah_jenis'])->name('AdminTambahjenis');
// Route::post('/editjenis{id}',[DashboardController::class, 'admin_edit_jenis'])->name('AdminEditjenis');
// Route::delete('/jenis/{id}', [DashboardController::class, 'jenis_destroy'])->name('jenis.destroy');
});
