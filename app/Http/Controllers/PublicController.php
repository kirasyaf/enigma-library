<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->category || $request->title) {
            $books = Book::where('title', 'like', '%'. $request->title.'%')
                    ->orWhereHas('categories', function ($q) use($request) {
                        $q->where('categories.id', $request->category);
                })
                ->get();
        } else {
            $books = Book::all();
        }

        return view('book-list', ['books' => $books, 'categories' => $categories]);
    }

    public function detail($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view('book-detail-list', ['book' => $book, 'categories' => $categories]);
    }
}