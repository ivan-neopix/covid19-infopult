<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopeSearch(Builder $query, string $searchTerm)
    {
        $query->where(function (Builder $query) use ($searchTerm) {
            $searchFields = $this->searchBy();
            if (!is_array($searchFields)) {
                $searchFields = [$searchFields];
            }

            collect($searchFields)->crossJoin(explode(' ', $searchTerm))
                                  ->each(function ($fieldAndTerm) use ($query) {
                                      $query->orwhere($fieldAndTerm[0], 'like', "%{$fieldAndTerm[1]}%");
                                  });
        });
    }

    protected function searchBy(): array
    {
        return ['name'];
    }
}
