<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use SoftDeletes;

    function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getImageAttribute($value)
    {
        return $value ? asset('uploads/' . $value) : '';
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->name, '-');
    }

    public function getImageContentsAttribute()
    {
        return file_get_contents($this->image);
    }
}
