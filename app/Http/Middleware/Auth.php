<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$akses)
    {
       
        if (in_array(1, $akses)) {
            if(empty(Session::get('user'))){
                Session::flush();
                Session::forget('user');
                return redirect('/');
            }
        } elseif (in_array(2, $akses)) {
            if(empty(Session::get('karyawan'))){
                Session::flush();
                Session::forget('karyawan');
                return redirect('/');
            }
        }
        return $next($request);
    }
}
