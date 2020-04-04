<?php

namespace Tests\Traits;

use App\Models\Admin;

trait AuthenticatedAdmin
{
    /** @var \App\Models\Admin */
    protected $admin;

    public function createAndAuthenticateAdmin()
    {
        $this->admin = factory(Admin::class)->create($this->overrideAuthenticatedAdmin());

        $this->be($this->admin, 'admin');
    }

    protected function overrideAuthenticatedAdmin(): array
    {
        return [];
    }
}
