<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Collection;

class NewTagsCreated
{
    use Dispatchable;

    /** @var \Illuminate\Support\Collection */
    public $tags;

    public function __construct(Collection $tags)
    {
        $this->tags = $tags;
    }
}
