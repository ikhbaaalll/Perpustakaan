<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->withCount('books')->get();

        return view('pages.admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.admin.category.create');
    }

    public function store(CategoryRequest $categoryRequest)
    {
        Category::create($categoryRequest->validated());

        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        return view('pages.admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $categoryRequest, Category $category)
    {
        $category->update($categoryRequest->validated());

        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}
