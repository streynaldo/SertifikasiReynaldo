<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class UserViewController extends Controller
{
    public function index(Request $request)
    {
        $title = 'List Buku';
        $data = Book::where('user_id', null)->paginate(5);
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

        return view('user-booklist', compact('title', 'data', 'categories'));
    }


    public function borrow(string $id)
    {
        $book = Book::find($id);
        $book->user_id = Auth::user()->id;
        $book->borrow_date = now()->format('Y-m-d');
        $book->save();

        return redirect()->route('book-list')->with('success', 'Buku berhasil dipinjam');
    }

    public function borrowList()
    {
        $title = 'List Buku';
        $user = Auth::user()->id;
        $data = Book::where('user_id', $user)->paginate(5);
        return view('user-borrowlist', compact('title', 'data'));
    }

    public function bringBack(string $id)
    {
        $book = Book::find($id);
        $book->user_id = null;
        $book->borrow_date = null;
        $book->save();

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan');
    }
}
