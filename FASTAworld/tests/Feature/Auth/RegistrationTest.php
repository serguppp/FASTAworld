<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email_register' => 'test@example.com',
            'password_register' => 'password',
            'password_register_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('upload', absolute: false));
    }
}
