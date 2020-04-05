<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Searchable;

    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_DECLINED = 'declined';

    const STATUSES = [
        self::STATUS_PENDING => 'Na čekanju',
        self::STATUS_ACCEPTED => 'Prihvaćeno',
        self::STATUS_DECLINED => 'Odbijeno'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    protected function searchBy(): array
    {
        return ['title'];
    }

    public function scopeForCategory(Builder $query, $categoryId)
    {
        $query->where('category_id', $categoryId);
    }

    public function scopeWithStatus(Builder $query, $status)
    {
        $query->where('status', $status);
    }

    public function scopeAccepted(Builder $query)
    {
        return $query->where('posts.status', Post::STATUS_ACCEPTED);
    }
}
