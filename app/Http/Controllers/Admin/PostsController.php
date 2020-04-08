<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query()
                     ->with('category', 'tags')
                     ->latest();

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

        if ($category = $request->input('category')) {
            $query->forCategory($category);
        }

        if ($status = $request->input('status')) {
            $query->withStatus($status);
        }

        $posts = $query->paginate(10)
                       ->appends([
                            'search' => $searchTerm,
                            'category' => $category,
                            'status' => $status,
                            'tags' => $tags,
                        ]);

        $categories = Category::all();
        $statuses = POST::STATUSES;


        return view('admin.posts.index', compact('searchTerm', 'posts', 'category', 'categories', 'status', 'statuses', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $post->status = Post::STATUS_ACCEPTED;
        $post->admin_id = $request->user()->id;

        $post->update();

        return redirect()->back()
            ->with('success', 'Post prihvaćen.');
    }

    public function destroy(Request $request, Post $post)
    {
        $post->status = Post::STATUS_DECLINED;
        $post->admin_id = $request->user()->id;

        $post->update();

        return redirect()->back()
            ->with('success', 'Post odbijen.');
    }
}
