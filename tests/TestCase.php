<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Traits\AuthenticatedAdmin;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUpTraits()
    {
        $traits = parent::setUpTraits();

        if (in_array(AuthenticatedAdmin::class, $traits)) {
            $this->createAndAuthenticateAdmin();
        }
    }
}
