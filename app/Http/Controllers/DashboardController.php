<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Laporan;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function passwordAdmin() {
        return view('/admin/password',['nama' => 'password'])->with('activeTab','data-password');
    }

    public function passwordKaryawan() {
        return view('/karyawan/password',['nama' => 'password'])->with('activeTab','data-password');
    }

    public function UpdatePassword(Request $request)
    {
        $id   = $request->id;
        $type = $request->type;

        $rules = [];
        $rules = Arr::add($rules, 'password_old', 'required');
        $rules = Arr::add($rules, 'password',     'required|min:6');
        $rules = Arr::add($rules, 'password2',     'required|same:password');

        $customMessage = [
            'required' => 'Wajib Di Isi',
            'min'      => 'Minimal 6 Karakter',
            'same'     => 'Password Yang Anda Masukan Tidak Sama'
        ];


        $request->validate($rules, $customMessage);
        if ($type == 'user') {
            $password = User::where('id_user', $id)->first();
        } else {
            $password = Karyawan::where('id_karyawan', $id)->first();
        }

        if (!Hash::check($request->password_old, $password->password)) {
            $response = [
                'response' => [
                    'error'   => 401,
                    'message' => 'Password Lama Anda Salah',
                    'data'    =>  NULL
                ]
            ];
        } else {

            $data['password']    = bcrypt($request->password2);
            $data['updated_at']  = Carbon::now();

            DB::beginTransaction();
            try {
                if ($type == 'user') {
                    User::where('id_user', $id)->update($data);
                } else {
                    Karyawan::where('id_karyawan', $id)->update($data);
                }

                DB::commit();
                $response = [
                    'response' => [
                        'success' => 1,
                        'message' => 'Anda Berhasil Merubah Password Baru',
                        'data'    => NULL
                    ]
                ];
            } catch (Exception $e) {
                DB::rollback();
                $response = [
                    'response' => [
                        'errors'  => 3306,
                        'message' => 'DataBase Error',
                        'data'    => NULL
                    ]
                ];
            }
        }

        return response()->json($response);
    }
}
