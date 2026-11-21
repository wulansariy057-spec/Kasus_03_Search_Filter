<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // Mengubah dari $request->search menjadi $request->keyword sesuai form Blade
        $keyword = $request->keyword;

        $books = Book::with('category')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                      ->orWhere('author', 'like', '%' . $keyword . '%');
            })
            // Mengubah dari $request->kategori menjadi $request->category sesuai form Blade
            ->when($request->category, function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('books.index', compact('categories', 'books'));
    }
}