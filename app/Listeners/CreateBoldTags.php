<?php

namespace App\Listeners;

use App\Events\NewTagsCreated;
use App\Models\Tag;
use App\Services\Transliterator;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateBoldTags implements ShouldQueue
{
    /** @var \App\Services\Transliterator  */
    private $transliterator;

    public function __construct(Transliterator $transliterator)
    {
        $this->transliterator = $transliterator;
    }

    public function handle(NewTagsCreated $event)
    {
        $tags = $event->tags;

        $bolds = $tags->map(function (string $tagName) {
            $bold = strtolower($this->transliterator->transliterate($tagName));

            if ($bold !== $tagName) {
                return $bold;
            }

            return null;
        })->filter()->unique();

        $newBolds = $bolds->diff(Tag::whereIn('name', $bolds)->pluck('name'));

        if ($newBolds->isNotEmpty()) {
            Tag::query()->insert($bolds->map(function (string $bold) {
                return ['name' => $bold];
            })->toArray());
        }
    }
}
