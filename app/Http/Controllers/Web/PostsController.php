<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HandlesTags;
use App\Http\Requests\Web\FilterPostsRequest;
use App\Http\Requests\Web\PostsRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class PostsController extends Controller
{
    use HandlesTags;

    public function index(FilterPostsRequest $request)
    {
        $query = Post::query()
                     ->latest()
                     ->with('tags')
                     ->accepted();

        if ($searchTerm = $request->input('search')) {
            $query->search($searchTerm);
        }

        if ($tags = $request->input('tags')) {
            $tagList = collect(explode(' ', $request->input('tags')));
            $existingTags = Tag::whereIn('name', $tagList)->get();

            if (count($existingTags) > 0) {
                $query->whereHas('tags', function (Builder $query) use ($existingTags) {
                    $query->whereIn('tags.id', $existingTags);
                });
            }
        }

        if ($categoryId = $request->input('category')) {
            $query->forCategory($categoryId);
        }

        $posts = $query->paginate($perPage = $request->input('per_page', 10))->appends([
            'search' => $searchTerm,
            'tags' => $tags,
            'category' => $categoryId,
            'per_page' => $perPage,
        ]);

        $categories = Category::all();

        return view('web.posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'searchTerm' => $searchTerm,
            'category' => $categoryId,
            'tags' => $tags,
        ]);
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('web.posts.create', compact('categories'));
    }

    public function store(PostsRequest $request)
    {
        $post = new Post();

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->link = $request->input('link');
        $post->category_id = $request->input('category_id');

        $post->status = Post::STATUS_PENDING;

        $post->save();

        $post->tags()->sync($this->prepareTagIds($request));

        return redirect()->route('homepage')
            ->with('success', 'Vaša objava je kreirana i biće objavljena kada je administratori odobre.');
    }
}
