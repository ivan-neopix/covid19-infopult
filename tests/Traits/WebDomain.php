<?php

namespace Tests\Traits;

use Illuminate\Support\Str;

trait WebDomain
{
    protected function prepareUrlForRequest($uri)
    {
        if (!Str::startsWith($uri, ['http', 'https'])) {
            $uri = config('app.web_domain') . $uri;
        }

        return $uri;
    }
}
