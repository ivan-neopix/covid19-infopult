<?php

namespace App\Console\Commands;

use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class NormalizeTagsCommand extends Command
{
    protected $signature = 'tags:normalize';

    protected $description = 'Normalize all of the tags available in the database.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tags = Tag::all();

        $this->info("Converting uppercase tags to lowercase");
        $convertedCount = $this->convertToLowercase();
        $this->info("Converted {$convertedCount} tags to lowercase\n");

        $this->info("Removing duplicate tags.");
        $removedCount = $this->removeDuplicates($tags);
        $this->info("Removed {$removedCount} duplicates");
    }

    private function convertToLowercase()
    {
        $query = Tag::query();

        return $query->update([
            'name' => $query->raw('LOWER(name)'),
        ]);
    }

    private function removeDuplicates(Collection $tags)
    {
        $keyedById = $tags->keyBy('id');

        $filtered = $tags->keyBy(function (Tag $tag) { return strtolower($tag->name); });
        $filtered->each(function (Tag $original) use ($keyedById) {
            $duplicates = $keyedById->except($original->id)->where('name', $original->name);

            if ($duplicates->isEmpty()) {
                return;
            }

            DB::table('post_tag')->whereIn('tag_id', $duplicates->pluck('id'))->update(['tag_id' => $original->id]);
            Tag::query()->whereIn('id', $duplicates->pluck('id'))->delete();
            $keyedById->forget($duplicates->pluck('id')->toArray());
        });

        return $tags->count() - $keyedById->count();
    }
}
