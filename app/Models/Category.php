<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function getImageContentsAttribute()
    {
        if (is_file($this->image)) {
            return file_get_contents($this->image);
        }
    }
}
