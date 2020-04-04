<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        $query = Tag::query()->orderBy('name', 'asc');

        if ($searchTerm = $request->input('search')) {
            $query->search($searchTerm);
        }

        return view('admin.tags.index', [
            'searchTerm' => $searchTerm ?? '',
            'tags' => $query->paginate(50),
        ]);
    }
}
