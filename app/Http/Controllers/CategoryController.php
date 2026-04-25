<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('name')->get();

        return view('category.index', compact('categories'));
    }

    public function create()
    {
        Gate::authorize('manage-category');

        return view('category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        Gate::authorize('manage-category');

        Category::create($request->validated());

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        Gate::authorize('manage-category');

        return view('category.edit', compact('category'));
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        Gate::authorize('manage-category');

        $category->update($request->validated());

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        Gate::authorize('manage-category');

        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}