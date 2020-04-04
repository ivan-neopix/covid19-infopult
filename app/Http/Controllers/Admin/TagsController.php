<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        $query = Tag::query()
                    ->withCount('posts')
                    ->orderBy('name', 'asc');

        if ($searchTerm = $request->input('search')) {
            $query->search($searchTerm);
        }

        return view('admin.tags.index', [
            'searchTerm' => $searchTerm ?? '',
            'tags' => $query->paginate(50),
        ]);
    }

    public function show(Tag $tag)
    {
        $posts = $tag->posts()->latest()->paginate(10);
        $postsCount = $posts->total();

        return view('admin.tags.show', compact('tag', 'posts', 'postsCount'));
    }

    public function create()
    {
        return view('admin.tags.create', [
            'tag' => new Tag(),
        ]);
    }

    public function store(TagRequest $request)
    {
        $tag = new Tag();

        $tag->name = $request->input('name');
        $tag->save();

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag uspešno kreiran.');
    }
}
