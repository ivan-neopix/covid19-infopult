<?php

namespace App\Models;

use App\Models\Traits\Searchable;
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
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    protected function searchBy(): array
    {
        return ['title'];
    }

    public function scopeForCategory($query, $categoryId)
    {
        $query->where('category_id', $categoryId);
    }

    public function scopeWithStatus($query, $status)
    {
        $query->where('status', $status);
    }
}
