<?php

namespace App\Http\Controllers;

use App\Events\NewTagsCreated;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

trait HandlesTags
{
    protected function prepareTagIds(Request $request): Collection
    {
        $tags = collect(explode(' ', $request->input('tags')))->map(function (string $tagName) { return mb_strtolower($tagName); })->unique();

        $newTags = $tags->diff(Tag::whereIn('name', $tags)->pluck('name'));
        Tag::insert($newTags->map(function ($tagName) {
            return ['name' => $tagName];
        })->toArray());

        if ($newTags->isNotEmpty()) {
            NewTagsCreated::dispatch($newTags);
        }


        $query = Tag::query();
        $collatedTags = $tags->map(function (string $tagName) use ($query) {
            return $query->raw("'{$tagName}' COLLATE utf8mb4_croatian_ci");
        });

        return $query->whereIn('name', $collatedTags)->pluck('id');
    }
}
