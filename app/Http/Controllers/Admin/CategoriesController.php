<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::query()->orderBy('name', 'asc')->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
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
        //
    }
}
