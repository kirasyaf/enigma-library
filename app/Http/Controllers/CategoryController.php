<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $categories = Category::where('name', 'LIKE', '%' . $keyword . '%')
        ->get();
        return view('category', ['categories' => $categories]);
    }

    public function add()
    {
        return view ('category-add');
    }

    public function store (Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100'
        ]);

        $category = Category::create($request->all());
        return redirect('categories')->with('status', 'Category Added Successfully');
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('category-edit', ['category' => $category]);
    }

    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100'
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug = null;
        $category->update($request->all());
        return redirect('categories')->with('status', 'Category Updated Succesfully');
    }

    public function delete($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('category-delete', ['category' => $category]);
    }

    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $category->delete();
        return redirect('categories')->with('status', 'Category Deleted Successfully!');
    }

    public function deletedCategory()
    {
        $deletedCategories = Category::onlyTrashed()->get();
        return view('category-deleted-list', ['deletedCategories' => $deletedCategories]);
    }

    public function restore($slug)
    {
        $category = Category::withTrashed()->where('slug', $slug)->first();
        $category->restore();
        return redirect('categories')->with('status', 'Category Restored Successfully!');
    }
    public function permanentDelete($slug)
    {
        $deletedCategory = Category::withTrashed()->where('slug', $slug)->first();

        if ($deletedCategory) {
            $booksWithCategory = Book::whereHas('categories', function ($query) use ($deletedCategory) {
                $query->where('categories.id', $deletedCategory->id);
            })->get();

            foreach ($booksWithCategory as $book) {
                $book->categories()->detach($deletedCategory->id);
            }

            $deletedCategory->books()->detach();
            $deletedCategory->forceDelete();

            Session::flash('status', 'success');
            Session::flash('message', "Delete Permanent Category data $deletedCategory->name successfully");

            return redirect('/categories');
        }

        // return redirect('/categories')->with('status', 'Category Not Found!');
    }

}