<?php

namespace App\Models;

use App\Services\Transliterator;
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

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'bold' => with(new Transliterator())->transliterate($this->name),
        ];
    }
}
