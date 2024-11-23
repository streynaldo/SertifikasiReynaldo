<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!Auth::check()){
            return redirect('/login');
        }

        // Cek user sudah login
        if (Auth::check() && in_array(!Auth::user()->role, [2])) {
            // Redirect ke halaman dashboard jika sudah login
            return redirect('/')->with('status', 'Login Sukses.');
        }

        // Jika belum login, lanjutkan ke request berikutnya
        return $next($request);
    }
}
