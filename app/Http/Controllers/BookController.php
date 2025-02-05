<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
    $keyword = $request->keyword;

    $books = Book::with('categories')
        ->where('title', 'LIKE', '%' . $keyword . '%')
        ->get();

    return view('book', ['books' => $books]);
    }


    public function add()
    {
        $categories = Category::all();
        return view('book-add', ['categories' => $categories]);
    }


    public function store (Request $request)
    {
        $validated = $request->validate([
            'book_code' => 'required|unique:books|max:255',
            'title' => 'required|max:255'
        ]);

        $newName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);
        }

        $request['cover'] = $newName;
        $book = Book::create($request->all());
        $book->categories()->sync($request->categories);
        return redirect('books')->with('status', 'Book Added Successfully!');
    }

    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view('book-edit', ['categories' => $categories, 'book' => $book]);
    }

    public function update(Request $request, $slug)
    {
        $newName = '';

        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);
            $request['cover'] = $newName;
        }
        $book = Book::where('slug', $slug)->first();
        
        $book->update($request->all());
        if ($request->categories) {
            $book->categories()->sync($request->categories);
        }

        return redirect('books')->with('status', 'Book Updated Successfully!');
    }

    public function delete($slug)
    {
        $book = Book::where('slug', $slug)->first();
        return view('book-delete', ['book' => $book]);
    }

    public function destroy($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $book->delete();
        return redirect('books')->with('status', 'Book Deleted Successfully!');
    }

    public function deletedBook()
    {
        $deletedBooks = Book::onlyTrashed()->get();
        return view('book-deleted-list', ['deletedBooks' => $deletedBooks]);
    }

    public function restore($slug)
    {
        $book = Book::withTrashed()->where('slug', $slug)->first();
        $book->restore();
        return redirect('books')->with('status', 'Book Restored Successfully!');
    }

    public function permanentDelete($slug)
    {
        $deletedBook = Book::withTrashed()->where('slug', $slug)->first();

        // Menghapus data terkait di tabel anak
        $deletedBook->bookCategories()->delete();

        RentLogs::where('book_id', $deletedBook->id)->forceDelete();

        Storage::disk('public')->delete('cover/' . $deletedBook->cover);
        $deletedBook->forceDelete();

        if ($deletedBook) {
            Session::flash('status', 'success');
            Session::flash('message', "Delete Permanent Book data $deletedBook->name successfully");
        }

        return redirect('/books');
    }
}