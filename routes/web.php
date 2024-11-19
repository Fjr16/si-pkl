<?php

use App\Http\Controllers\AbsensiSiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DudiController;
use App\Http\Controllers\JurnalHarianController;
use App\Http\Controllers\LaporanAkhirController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PklController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

// Auth
Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('login.logout');
Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->middleware('guest')->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendLink'])->middleware('guest')->name('password.email');
Route::get('reset-password/{token}', [AuthController::class, 'resetPasswordToken'])->middleware('guest')->name('password.reset');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Data User
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // Data Guru
    Route::get('guru', [TeacherController::class, 'index'])->name('guru.index');
    Route::get('guru/create', [TeacherController::class, 'create'])->name('guru.create');
    Route::post('guru/store', [TeacherController::class, 'store'])->name('guru.store');
    Route::get('guru/edit/{id}', [TeacherController::class, 'edit'])->name('guru.edit');
    Route::put('guru/update/{id}', [TeacherController::class, 'update'])->name('guru.update');
    Route::delete('guru/destroy/{id}', [TeacherController::class, 'destroy'])->name('guru.destroy');

    // Data DUDI
    Route::get('dudi', [DudiController::class, 'index'])->name('dudi.index');
    Route::get('dudi/create', [DudiController::class, 'create'])->name('dudi.create');
    Route::post('dudi/store', [DudiController::class, 'store'])->name('dudi.store');
    Route::get('dudi/edit/{id}', [DudiController::class, 'edit'])->name('dudi.edit');
    Route::put('dudi/update/{id}', [DudiController::class, 'update'])->name('dudi.update');
    Route::delete('dudi/destroy/{id}', [DudiController::class, 'destroy'])->name('dudi.destroy');

    // Data Siswa
    Route::get('siswa', [StudentController::class, 'index'])->name('siswa.index');
    Route::get('siswa/create', [StudentController::class, 'create'])->name('siswa.create');
    Route::post('siswa/store', [StudentController::class, 'store'])->name('siswa.store');
    Route::get('siswa/edit/{id}', [StudentController::class, 'edit'])->name('siswa.edit');
    Route::put('siswa/update/{id}', [StudentController::class, 'update'])->name('siswa.update');
    Route::delete('siswa/destroy/{id}', [StudentController::class, 'destroy'])->name('siswa.destroy');

    // Data Jurusan
    Route::get('jurusan', [MajorController::class, 'index'])->name('jurusan.index');
    Route::get('jurusan/create', [MajorController::class, 'create'])->name('jurusan.create');
    Route::post('jurusan/store', [MajorController::class, 'store'])->name('jurusan.store');
    Route::get('jurusan/edit/{id}', [MajorController::class, 'edit'])->name('jurusan.edit');
    Route::put('jurusan/update/{id}', [MajorController::class, 'update'])->name('jurusan.update');
    Route::delete('jurusan/destroy/{id}', [MajorController::class, 'destroy'])->name('jurusan.destroy');

    // Absensi Siswa
    Route::get('absensi/siswa', [AbsensiSiswaController::class, 'index'])->name('absensi/siswa.index');
    Route::get('absensi/siswa/create', [AbsensiSiswaController::class, 'create'])->name('absensi/siswa.create');
    Route::post('absensi/siswa/store', [AbsensiSiswaController::class, 'store'])->name('absensi/siswa.store');
    Route::get('absensi/siswa/edit/{id}', [AbsensiSiswaController::class, 'edit'])->name('absensi/siswa.edit');
    Route::put('absensi/siswa/update/{id}', [AbsensiSiswaController::class, 'update'])->name('absensi/siswa.update');
    Route::delete('absensi/siswa/destroy/{id}', [AbsensiSiswaController::class, 'destroy'])->name('absensi/siswa.destroy');
    
    // Jurnal Harian
    Route::get('jurnal/harian', [JurnalHarianController::class, 'index'])->name('jurnal/harian.index');
    Route::get('jurnal/harian/create', [JurnalHarianController::class, 'create'])->name('jurnal/harian.create');
    Route::post('jurnal/harian/store', [JurnalHarianController::class, 'store'])->name('jurnal/harian.store');
    Route::get('jurnal/harian/edit/{id}', [JurnalHarianController::class, 'edit'])->name('jurnal/harian.edit');
    Route::put('jurnal/harian/update/{id}', [JurnalHarianController::class, 'update'])->name('jurnal/harian.update');
    Route::delete('jurnal/harian/destroy/{id}', [JurnalHarianController::class, 'destroy'])->name('jurnal/harian.destroy');

    // Laporan Akhir
    Route::get('laporan/akhir', [LaporanAkhirController::class, 'index'])->name('laporan/akhir.index');
    Route::get('laporan/akhir/create', [LaporanAkhirController::class, 'create'])->name('laporan/akhir.create');
    Route::post('laporan/akhir/store', [LaporanAkhirController::class, 'store'])->name('laporan/akhir.store');
    Route::get('laporan/akhir/download/{id}', [LaporanAkhirController::class, 'download'])->name('laporan/akhir.download');

    // Monitoring guru
    Route::get('monitoring/guru', [MonitoringController::class, 'index'])->name('monitoring/guru.index');
    Route::get('monitoring/guru/create', [MonitoringController::class, 'create'])->name('monitoring/guru.create');
    Route::post('monitoring/guru/store', [MonitoringController::class, 'store'])->name('monitoring/guru.store');
    Route::get('monitoring/guru/edit/{id}', [MonitoringController::class, 'edit'])->name('monitoring/guru.edit');
    Route::put('monitoring/guru/update/{id}', [MonitoringController::class, 'update'])->name('monitoring/guru.update');
    Route::delete('monitoring/guru/destroy/{id}', [MonitoringController::class, 'destroy'])->name('monitoring/guru.destroy');
    Route::get('monitoring/get/pkl/data/{id}', [MonitoringController::class, 'getPklData'])->name('monitoring/get/pkl.data');

    // Data PKL
    Route::get('data/pkl/siswa', [PklController::class, 'index'])->name('data/pkl/siswa.index');
    Route::get('data/pkl/siswa/create', [PklController::class, 'create'])->name('data/pkl/siswa.create');
    Route::post('data/pkl/siswa/store', [PklController::class, 'store'])->name('data/pkl/siswa.store');
    Route::get('data/pkl/siswa/edit/{id}', [PklController::class, 'edit'])->name('data/pkl/siswa.edit');
    Route::put('data/pkl/siswa/update/{id}', [PklController::class, 'update'])->name('data/pkl/siswa.update');
    Route::delete('data/pkl/siswa/destroy/{id}', [PklController::class, 'destroy'])->name('data/pkl/siswa.destroy');
    Route::get('get/data/dudi/{id}', [PklController::class, 'getDataDudi'])->name('get/data.dudi');
    
    // Sertifikat
    Route::get('sertifikat', [SertifikatController::class, 'index'])->name('sertifikat.index');
    Route::get('sertifikat/create', [SertifikatController::class, 'create'])->name('sertifikat.create');
    Route::post('sertifikat/store', [SertifikatController::class, 'store'])->name('sertifikat.store');
    Route::get('sertifikat/edit/{id}', [SertifikatController::class, 'edit'])->name('sertifikat.edit');
    Route::put('sertifikat/update/{id}', [SertifikatController::class, 'update'])->name('sertifikat.update');
    Route::delete('sertifikat/destroy/{id}', [SertifikatController::class, 'destroy'])->name('sertifikat.destroy');
});
