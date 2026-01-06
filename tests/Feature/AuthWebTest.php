<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthWebTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_login_and_signup_pages(): void
    {
        $this->get('/login')->assertStatus(200);
        $this->get('/signup')->assertStatus(200);
    }

    public function test_user_can_sign_up_and_is_redirected_to_profile(): void
    {
        $response = $this->post('/signup', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'mobile_number' => '+1 555 0000',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertRedirect('/profile');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'jane@example.com']);
    }

    public function test_user_can_log_in_and_is_redirected_home(): void
    {
        $user = User::factory()->create([
            'email' => 'jane@example.com',
            'password' => Hash::make('secret123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'jane@example.com',
            'password' => 'secret123',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_logout_and_is_redirected_home(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
