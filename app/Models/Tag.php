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

    public function setNameAttribute(string $name)
    {
        $this->attributes['name'] = str_replace(' ', '_', $name);
    }

    public function getTagAttribute()
    {
        return "#{$this->name}";
    }
}
