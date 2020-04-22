<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;

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

        // Added this in here not in the request because I didn't want to make
        // a new request for edit because there this is not required
        if (!$request->hasFile('image')) {
            return redirect()->route('admin.categories.create')
                ->withInput($request->input())
                ->withErrors(['image' => 'Polje slika je obavezno']);
        }

        $categoryName = $request->input('name');
        $imageFilename = $this->generateFileName($categoryName);

        $request->file('image')->move(public_path('uploads'), $imageFilename);

        $category->name = $categoryName;
        $category->image = $imageFilename;

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
        $categoryName = $request->input('name');
        $category->name = $categoryName;

        // Update image if it exists
        if ($request->hasFile('image')) {
            $imageFilename = $this->generateFileName($categoryName);

            $request->file('image')->move(public_path('uploads'), $imageFilename);

            $category->image = $imageFilename;
        }

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

    private function generateFileName($name)
    {
        return implode('-', [
                Str::slug($name),
                date('YmdHis'),
            ]) . '.svg';
    }
}
