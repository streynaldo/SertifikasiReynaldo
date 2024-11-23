<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Register()
    {
        if (Auth::check()) {
            // Jika pengguna sudah login, redirect ke dashboard
            return redirect('/')->with('status', 'Anda sudah login!');
        }

        // Tampilkan halaman register
        $title = 'Register Page';
        return view('auth.register', compact('title'));
    }

    public function ValidateRegister(Request $request)
    {
        // Validasi inputan
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'phone' => ['nullable', 'string', 'max:12', 'min:9', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
        ]);

        // cek apakah sudah ada user yang sama sebelumnya
        $user = User::where('email', $data['email'])->first();
        if ($user) {
            return redirect()->back()->with('error', 'Email sudah terdaftar!');
        }

        // Hash password
        $data['password'] = Hash::make($data['password']);

        $photo_path = '';
        if ($request->hasFile('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $newName = 'foto_profil' . '-' . now()->timestamp . '.' . $extension;
            $photo_path = $request->file('photo')->storeAs('foto_profil', $newName, 'public');
            $data['photo'] = $photo_path;
        } else {
            return redirect()->back()->with('error', 'Foto profil harus diisi!');
        }

        // Buat user baru
        User::create($data);

        // // Login user
        // Auth::login($user);

        // Redirect ke dashboard
        return redirect('/login')->with('status', 'Registrasi berhasil!');
    }

    public function Login()
    {
        if (Auth::check()) {
            // Jika pengguna sudah login, redirect ke dashboard
            return redirect('/')->with('status', 'Anda sudah login!');
        }

        // Tampilkan halaman login
        $title = 'Login';
        return view('auth.login', compact('title'));
    }

    public function ValidateLogin(Request $request)
    {
        // Validasi inputan
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kredensial
        if (Auth::attempt($data)) {
            // Ambil data user
            $user = Auth::user();

            // Periksa role
            if ($user->role == '1' || $user->role == 1) {
                // Regenerate session untuk keamanan
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            } else if ($user->role == '2' || $user->role == 2) {
                // Regenerate session untuk keamanan
                $request->session()->regenerate();
                return redirect()->intended('/');
            }

            // Logout jika bukan admin atau bukan role user
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/')->with('error', 'Akses tidak diizinkan untuk akun Anda.');
        }

        // Jika login gagal
        return redirect()->back()->with('error', 'Email atau password salah.');
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();


        // Redirect ke halaman login
        return redirect('login')->with('success', 'Anda telah logout.');
    }
}
