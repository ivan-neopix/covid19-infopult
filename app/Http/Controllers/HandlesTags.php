<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

trait HandlesTags
{
    protected function prepareTagIds(Request $request): Collection
    {
        $tags = collect(explode(' ', $request->input('tags')));

        $existingTags = Tag::whereIn('name', $tags)->get();

        $newTags = $tags->diff($existingTags->pluck('name'));
        Tag::insert($newTags->map(function ($tagName) {
            return ['name' => strtolower($tagName)];
        })->toArray());

        Tag::whereIn('name', $newTags)->searchable();

        return Tag::whereIn('name', $tags)->pluck('id');
    }
}
