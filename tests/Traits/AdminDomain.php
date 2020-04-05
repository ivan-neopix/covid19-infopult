<?php

namespace Tests\Traits;

use Illuminate\Support\Str;

trait AdminDomain
{
    protected function prepareUrlForRequest($uri)
    {
        if (!Str::startsWith($uri, ['http', 'https'])) {
            $uri = config('app.web_domain') . "/de-si-poso{$uri}";
        }

        return $uri;
    }
}
