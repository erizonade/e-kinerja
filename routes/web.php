<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\UserController;
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

Route::get('/', [LoginController::class,'index'])->name('index');
Route::post('login',[LoginController::class,'login'])->name('login');
Route::get('logout',[LoginController::class,'logout'])->name('logout');


Route::group(['prefix' => 'admin', 'middleware' => 'auths:1'],function(){
    Route::get('dashboard_admin',[DashboardController::class,'dashboardAdmin'])->name('dashboard_admin');    
    Route::get('password',[DashboardController::class,'passwordAdmin'])->name('password');    
    Route::post('update-password',[DashboardController::class,'UpdatePassword'])->name('password');    

    Route::get('riwayat-laporan-admin',[LaporanController::class,'riwayatLaporanAdmin'])->name('riwayat-laporan');
    Route::get('riwayat-laporan-print',[LaporanController::class,'printRiwayatLaporanAdmin'])->name('riwayat-laporan-print');
    Route::post('riwayat-laporan-list',[LaporanController::class,'listRiwayatLaporanAdmin'])->name('riwayat-laporan-list');
    Route::resource('user',UserController::class)->names('user');
    Route::resource('karyawan',KaryawanController::class)->names('karyawan');
    Route::resource('unitkerja',UnitKerjaController::class)->names('unitkerja');
    Route::resource('jabatan',JabatanController::class)->names('jabatan');
});

Route::group(['prefix' => 'karyawan', 'middleware' => 'auths:2'],function(){
    Route::get('dashboard_karyawan',[DashboardController::class,'dashboardKaryawan'])->name('dashboard_karyawan');  
    Route::get('password',[DashboardController::class,'passwordKaryawan'])->name('password');    
    Route::post('update-password',[DashboardController::class,'UpdatePassword'])->name('password');  
    Route::get('laporan-harian-bawahan',[LaporanController::class,'laporanBawahan'])->name('laporan-harian-bawahan');
    Route::get('verif-laporan',[LaporanController::class,'verifLaporan'])->name('verif-laporan');
    Route::get('riwayat-laporan',[LaporanController::class,'riwayatLaporan'])->name('riwayat-laporan');
    Route::get('riwayat-laporan-print',[LaporanController::class,'printRiwayatLaporan'])->name('riwayat-laporan-print');
    Route::post('riwayat-laporan-list',[LaporanController::class,'listRiwayatLaporan'])->name('riwayat-laporan-list');
    Route::resource('laporan-harian',LaporanController::class)->names('laporan-harian');
});
