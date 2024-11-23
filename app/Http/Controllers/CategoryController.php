<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Category List';
        $data = Category::paginate(5);

        return view('admin.category.dashboard', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Kategori Baru';
        return view('admin.category.create-category', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        $category = Category::where('name', $data['name'])->first();
        if ($category) {
            return redirect()->back()->with('error', 'Kategori sudah terdaftar!');
        }

        Category::create($data);

        return redirect()->route('categories.index')->with('status', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $title = 'Edit Kategori';
        return view('admin.category.edit-category', compact('title', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        $category->update($data);

        return redirect()->route('categories.index')->with('status', 'Kategori berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->books()->detach();

        $category->delete();

        return redirect()->route('categories.index')->with('status', 'Kategori berhasil dihapus!');
    }
}
