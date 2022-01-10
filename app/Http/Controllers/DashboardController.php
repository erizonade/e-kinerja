<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    //
    public function dashboardAdmin() {
        return view('/admin/dashboard',['nama' => 'Dashboard'])->with('activeTab','data-dashboard');
    }

    public function dashboardKaryawan() {
        $diterima = Laporan::where('id_karyawan', Session::get('karyawan')->id_karyawan)->where('status_laporan', 'Diterima')->count();
        $ditolak = Laporan::where('id_karyawan', Session::get('karyawan')->id_karyawan)->where('status_laporan', 'Ditolak')->count();
        $proses = Laporan::where('id_karyawan', Session::get('karyawan')->id_karyawan)->where('status_laporan', 'Proses')->count();
        return view('/karyawan/dashboard',['nama' => 'Dashboard', 'diterima' => $diterima, 'ditolak' => $ditolak, 'proses' => $proses])->with('activeTab','data-dashboard');
    }
}
