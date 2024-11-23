<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'User List';
        $data = User::paginate(10);

        return view('admin.user.dashboard', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah User Baru';
        $role = [
            'Admin',
            'User',
        ];


        return view('admin.user.create-user', compact('title', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi inputan
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'phone' => ['nullable', 'string', 'max:12', 'min:9', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'role' => ['required', 'numeric', 'in:1,2'],
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

        return redirect()->route('users.index')->with('status', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'List Peminjaman Buku User';
        $user = User::find($id);
        $data = Book::where('user_id', $id)->paginate(5);

        return view('admin.user.detail-user', compact('title', 'user', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit User';
        $role = [
            'Admin',
            'User',
        ];

        $user = User::find($id);

        // dd($user);

        return view('admin.user.edit-user', compact('title', 'role', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'phone' => ['nullable', 'string', 'max:12', 'min:9', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'role' => ['required', 'numeric', 'in:1,2'],
        ]);

        $user = User::find($id);

        $photo_path = '';
        if ($request->hasFile('photo')) {
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $extension = $request->file('photo')->getClientOriginalExtension();
            $newName = 'foto_profil' . '-' . now()->timestamp . '.' . $extension;
            $photo_path = $request->file('photo')->storeAs('foto_profil', $newName, 'public');
            $data['photo'] = $photo_path;
        }

        $user->update($data);

        return redirect()->route('users.index')->with('status', 'User berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return redirect()->route('users.index')->with('status', 'User berhasil dihapus!');
    }
}
