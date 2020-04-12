<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    protected function createPasswordResetToken(string $email, string $token)
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => bcrypt($token),
            'created_at' => now(),
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

    /** @test */
    public function guests_can_see_the_forgot_password()
    {
        $response = $this->get("/forgot-password");


        $response->assertSuccessful();
        $response->assertViewIs('auth.passwords.email');
    }

    /** @test */
    public function guests_can_request_a_reset_password_link()
    {
        $response = $this->post("/forgot-password", [
            'email' => 'admin@covid.com',
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('password_resets', [
            'email' => 'admin@covid.com'
        ]);
    }

    /** @test */
    public function guests_cannot_request_a_reset_password_link_using_an_invalid_email()
    {
        $response = $this->from("/forgot-password")->post("/forgot-password", [
            'email' => 'invalid@test.com',
        ]);


        $response->assertRedirect("/forgot-password");
        $response->assertSessionHasErrors('email');
        $this->assertDatabaseMissing('password_resets', []);
    }

    /** @test */
    public function guests_can_visit_the_reset_password_page()
    {
        $this->createPasswordResetToken('admin@covid.com', 'test-token');


        $response = $this->get("/reset-password/test-token");


        $response->assertSuccessful();
        $response->assertViewIs('auth.passwords.reset');
    }

    /** @test */
    public function guests_can_reset_their_passwords()
    {
        $this->createPasswordResetToken('admin@covid.com', 'test-token');


        $response = $this->post("/reset-password", [
            'email' => 'admin@covid.com',
            'password' => 'newPassword',
            'password_confirmation' => 'newPassword',
            'token' => 'test-token',
        ]);


        $response->assertRedirect("/de-si-poso/login");
        $this->assertTrue(Hash::check('newPassword', $this->admin->refresh()->password));
        $this->assertDatabaseMissing('password_resets', [
            'email' => 'admin@covid.com',
        ]);
    }

    /** @test */
    public function guests_cannot_reset_their_passwords_using_an_invalid_password()
    {
        $this->createPasswordResetToken('admin@covid.com', 'test-token');


        $response = $this->from("/de-si-poso/reset-password")->post("/reset-password", [
            'email' => 'admin@covid.com',
            'password' => 'short',
            'password_confirmation' => 'short',
            'token' => 'test-token',
        ]);


        $response->assertRedirect("/de-si-poso/reset-password");
        $this->assertFalse(Hash::check('short', $this->admin->refresh()->password));
        $this->assertDatabaseHas('password_resets', [
            'email' => 'admin@covid.com',
        ]);
    }

    /** @test */
    public function guests_cannot_reset_their_passwords_using_an_invalid_token()
    {
        $response = $this->from("/de-si-poso/reset-password")->post("/reset-password", [
            'email' => 'admin@covid.com',
            'password' => 'newPassword',
            'password_confirmation' => 'newPassword',
            'token' => 'test-token',
        ]);


        $response->assertRedirect("/de-si-poso/reset-password");
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Hash::check('newPassword', $this->admin->refresh()->password));
    }
}
