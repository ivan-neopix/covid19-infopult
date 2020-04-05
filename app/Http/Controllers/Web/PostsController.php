<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\FilterPostsRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class PostsController extends Controller
{
    public function index(FilterPostsRequest $request)
    {
        $query = Post::query()
                     ->latest()
                     ->with('tags')
                     ->accepted();

        if ($searchTerm = $request->input('search')) {
            $query->search($searchTerm);
        }

        if ($tagIds = $request->input('tags')) {
            $query->whereHas('tags', function (Builder $query) use ($tagIds) {
                $query->whereIn('tags.id', $tagIds);
            });
        }

        if ($categoryId = $request->input('category')) {
            $query->forCategory($categoryId);
        }

        $posts = $query->paginate($perPage = $request->input('per_page', 10))->appends([
            'search' => $searchTerm,
            'tags' => $tagIds,
            'category' => $categoryId,
            'per_page' => $perPage,
        ]);

        $categories = Category::all();

        return view('web.posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'searchTerm' => $searchTerm,
            'category' => $categoryId,
        ]);
    }

    public function create()
    {
        return view('web.posts.create');
    }
}
