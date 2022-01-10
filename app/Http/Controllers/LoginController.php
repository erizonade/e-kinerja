<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        return view('login');
    }

    public function login() 
    {
        $this->request->validate([
            'userName' => 'required',
            'password' => 'required'
        ],[
            'required' => 'Kolom harus di isi'
        ]);

        /** 
         * check Login Admin
        */
        $userName = $this->request->userName;
        $password = $this->request->password;

        $admin = User::where('username',$userName)->first();
        if ($admin) {
            if (Hash::check($password,$admin->password)) {
                if($admin->status === 1 && $admin->role === 1){
                    Session::put('user',$admin);
                    return redirect('/admin/dashboard_admin')->with('messages','Berhasil Login');
                } else {
                    return redirect('/')->with('messages','Login Tidak Valid!!!');
                }
            } else {
                return redirect('/')->with('messages','Login Tidak Valid!!!');
            }
        } else {
            $karyawan = Karyawan::where('nip',$userName)->first();
            if ($karyawan) {
                if (Hash::check($password,$karyawan->password)) {
                    if($karyawan->status === 1 && $karyawan->role === 2){
                        Session::put('karyawan',$karyawan);
                        return redirect('/karyawan/dashboard_karyawan')->with('messages','Berhasil Login');
                    } else {
                        return redirect('/')->with('messages','Login Tidak Valid!!!');
                    }
                } else {
                    return redirect('/')->with('messages','Login Tidak Valid!!!');
                }
            }else{
                return redirect('/')->with('messages','Login Tidak Valid!!!');
            }
        }

    }

    public function logout()
    {
        Session::flush();
        Session::forget('user');
        Auth::logout();
        return redirect('/');
    }
}
