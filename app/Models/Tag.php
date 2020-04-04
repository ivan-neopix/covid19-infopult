<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Searchable;

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
