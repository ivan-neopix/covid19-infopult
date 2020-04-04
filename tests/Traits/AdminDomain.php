<?php

namespace Tests\Traits;

use Illuminate\Support\Str;

trait AdminDomain
{
    protected function prepareUrlForRequest($uri)
    {
        if (!Str::startsWith($uri, ['http', 'https'])) {
            $uri = config('app.admin_domain') . $uri;
        }

        return $uri;
    }
}
