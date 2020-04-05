<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Tag extends Model
{
    use Searchable;

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getTagAttribute()
    {
        return "#{$this->name}";
    }
}
