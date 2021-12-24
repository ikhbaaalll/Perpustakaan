<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookStoreRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Category $category)
    {
        $books = Book::query()
            ->whereBelongsTo($category)
            ->get();

        return view('pages.admin.book.index', compact('books', 'category'));
    }

    public function create(Category $category)
    {
        return view('pages.admin.book.create', compact('category'));
    }

    public function store(BookStoreRequest $bookStoreRequest, Category $category)
    {
        $category->books()->create($bookStoreRequest->validated());

        return redirect()->route('admin.categories.books');
    }

    public function show(Book $book)
    {
        //
    }

    public function edit(Book $book)
    {
        //
    }

    public function update(Request $request, Book $book)
    {
        //
    }

    public function destroy(Book $book)
    {
        //
    }
}
