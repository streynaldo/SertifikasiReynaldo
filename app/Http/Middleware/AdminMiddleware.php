<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah sudah login
        if (!Auth::check()) {
            // Redirect ke halaman login jika belum login
            return redirect()->route('login')->with('error', 'Silahkan login dulu.');
        }

        // Periksa apakah admin login dan memiliki role_id 1 (admin)
        if (Auth::check() && in_array(Auth::user()->role, [1])) {
            return $next($request);
        }

        // redirect ke login jika gagal
        return redirect('/login')->with('error', 'Akses ditolak.');
    }
}
