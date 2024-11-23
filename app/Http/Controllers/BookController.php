<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Book List';
        $data = Book::paginate(5);
        $categories = Category::all();

        if ($request->filter) {
            $filter = $request->filter;
            if ($filter == 'all') {
                $data = Book::where('user_id', null)->paginate(5);
            } else {
                $data = Book::whereHas('categories', function ($query) use ($filter) {
                    $query->where('name', $filter);
                })->where('user_id', null)->paginate(5);
            }
        }

        return view('admin.book.dashboard', compact('title', 'data', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Buku Baru';
        $kategori = Category::all();
        return view('admin.book.create-book', compact('title', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'publisher' => ['required', 'max:255'],
            'release_date' => ['required'],
            'description' => ['required'],
            'categories' => ['required', 'array'],
            'categories.*' => ['exists:categories,id'],
            'cover_photo' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $book = Book::where('title', $data['title'])->first();
        if ($book) {
            return redirect()->back()->with('status', 'Buku sudah terdaftar!');
        }

        $photo_path = '';
        if ($request->hasFile('cover_photo')) {
            $extension = $request->file('cover_photo')->getClientOriginalExtension();
            $newName = 'foto_buku' . '-' . now()->timestamp . '.' . $extension;
            $photo_path = $request->file('cover_photo')->storeAs('foto_buku', $newName, 'public');
            $data['cover_photo'] = $photo_path;
        } else {
            return redirect()->back()->with('status', 'Foto buku harus diisi!');
        }

        $data['user_id'] = null;
        $data['borrow_date'] = null;

        $book = Book::create($data);

        $book->categories()->attach($data['categories']);

        return redirect()->route('books.index')->with('status', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $title = 'Detail Buku';
        $kategori = $book->categories->pluck('name')->toArray();
        return view('admin.book.detail-book', compact('title', 'book', 'kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $title = 'Edit Buku';
        $kategori = Category::all();
        $selectedCategories = $book->categories->pluck('id')->toArray();
        // dd($selectedCategories);
        return view('admin.book.edit-book', compact('title', 'kategori', 'book', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'publisher' => ['required', 'max:255'],
            'release_date' => ['required'],
            'description' => ['required'],
            'categories' => ['required', 'array'],
            'categories.*' => ['exists:categories,id'],
            'cover_photo' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $photo_path = '';
        if ($request->hasFile('cover_photo')) {
            if ($book->cover_photo && Storage::disk('public')->exists($book->cover_photo)) {
                Storage::disk('public')->delete($book->cover_photo);
            }

            $extension = $request->file('cover_photo')->getClientOriginalExtension();
            $newName = 'foto_buku' . '-' . now()->timestamp . '.' . $extension;
            $photo_path = $request->file('cover_photo')->storeAs('foto_buku', $newName, 'public');
            $data['cover_photo'] = $photo_path;
        } else {
            $data['cover_photo'] = $book->cover_photo;
        }

        $book->update($data);

        $book->categories()->sync($data['categories']);

        return redirect()->route('books.index')->with('status', 'Buku berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->cover_photo && Storage::disk('public')->exists($book->cover_photo)) {
            Storage::disk('public')->delete($book->cover_photo);
        }

        $book->categories()->detach();

        $book->delete();

        return redirect()->route('books.index')->with('status', 'Buku berhasil dihapus!');
    }

    public function returnBook(string $id)
    {
        $book = Book::find($id);
        $book->user_id = null;
        $book->borrow_date = null;
        $book->save();

        return redirect()->back()->with('status', 'Buku berhasil dikembalikan!');
    }
}
