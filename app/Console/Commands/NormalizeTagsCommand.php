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
        $this->info("Converting uppercase tags to lowercase");
        $convertedCount = $this->convertToLowercase();
        $this->info("Converted {$convertedCount} tags to lowercase\n");

        $tags = Tag::all();
        $this->info("Removing duplicate tags.");
        $removedCount = $this->removeTagDuplicates($tags);
        $this->info("Removed {$removedCount} duplicates");

        $this->info("Removing duplicate post-tag connections.");
        $this->removePostTagDuplicates();
    }

    private function convertToLowercase()
    {
        $query = Tag::query();

        return $query->update([
            'name' => $query->raw('LOWER(name)'),
        ]);
    }

    private function removeTagDuplicates(Collection $tags)
    {
        $keyedById = $tags->keyBy('id');

        $filtered = $tags->keyBy(function (Tag $tag) { return strtolower($tag->name); });
        $filtered->each(function (Tag $original, String $name) use ($keyedById) {
            $duplicates = $keyedById->except($original->id)->where('name', $name);

            if ($duplicates->isEmpty()) {
                return;
            }

            DB::table('post_tag')->whereIn('tag_id', $duplicates->pluck('id'))->update(['tag_id' => $original->id]);
            Tag::query()->whereIn('id', $duplicates->pluck('id'))->delete();
            $keyedById->forget($duplicates->pluck('id')->toArray());
        });

        return $tags->count() - $keyedById->count();
    }

    private function removePostTagDuplicates()
    {
        $sql = 'DELETE pt1 FROM post_tag as pt1 JOIN post_tag as pt2 ON (pt1.post_id = pt2.post_id AND' .
            ' pt1.tag_id = pt2.tag_id) AND pt1.id > pt2.id';

        DB::statement($sql);
    }
}
