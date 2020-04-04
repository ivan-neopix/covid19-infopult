<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AdminDomain;

class AuthTest extends TestCase
{
    use AdminDomain, RefreshDatabase;

    /** @var \App\Models\Admin */
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = factory(Admin::class)->create([
            'email' => 'admin@covid.com',
            'password' => bcrypt('covid'),
        ]);
    }

    /** @test */
    public function guest_can_access_admin_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /** @test */
    public function guest_can_login()
    {
        $response = $this->post('/login', [
            'email' => 'admin@covid.com',
            'password' => 'covid'
        ]);

        $response->assertRedirect();
        $this->assertAuthenticatedAs($this->admin, 'admin');
    }

    /** @test */
    public function guest_can_login_and_ask_for_credentials_to_be_remembered()
    {
        $response = $this->post('/login', [
            'email' => 'admin@covid.com',
            'password' => 'covid',
            'remember' => 1
        ]);

        $response->assertRedirect();
        $this->assertAuthenticatedAs($this->admin, 'admin');
    }

    /** @test */
    public function guest_cannot_login_without_valid_credentials()
    {
        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'invalid'
        ]);

        $response->assertRedirect();
        $this->assertGuest('admin');
    }

    /** @test */
    public function admin_can_logout()
    {
        $this->actingAs($this->admin);

        $response = $this->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest('admin');
    }
}
