<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::query()
                              ->orderBy('name', 'asc')
                              ->withCount('posts')
                              ->paginate(10);
        
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create', [
            'category' => new Category(),
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $category = new Category();

        $category->name = $request->input('name');

        $category->save();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategorija uspešno dodata.');
    }

    public function edit(Category $category)
    {
        $posts = $category->posts()->latest()->paginate(10);
        $postsCount = $posts->total();

        return view('admin.categories.edit', compact('category', 'posts', 'postsCount'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->name = $request->input('name');

        $category->update();


        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategorija uspešno izmenjena.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategorija uspešno izbrisana.');
    }
}
