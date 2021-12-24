<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookStoreRequest;
use App\Http\Requests\Admin\BookUpdateRequest;
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

        return redirect()->route('admin.categories.books.index', $category);
    }

    public function edit(Category $category, Book $book)
    {
        return view('pages.admin.book.edit', compact('category', 'book'));
    }

    public function update(BookUpdateRequest $bookUpdateRequest, Category $category, Book $book)
    {
        $book->update($bookUpdateRequest->validated());

        return redirect()->route('admin.categories.books.index', $category)->with('status', "Sukses mengubah buku {$book->name}");
    }

    public function destroy(Category $category, Book $book)
    {
        $book->delete();

        return redirect()->route('admin.categories.books.index', $category)->with('status', "Sukses menghapus buku {$book->name}");
    }
}
