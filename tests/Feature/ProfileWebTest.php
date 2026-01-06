<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileWebTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_profile_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/profile')
            ->assertStatus(200)
            ->assertSee('Your public profile');
    }

    public function test_user_can_update_profile_details(): void
    {
        $user = User::factory()->create([
            'name' => 'Old Name',
            'mobile_number' => '123',
        ]);

        $response = $this->actingAs($user)->put('/profile', [
            'name' => 'New Name',
            'mobile_number' => '456',
        ]);

        $response->assertRedirect('/profile');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'New Name',
            'mobile_number' => '456',
        ]);
    }

    public function test_user_can_upload_profile_image(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $file = UploadedFile::fake()->image('avatar.png');

        $response = $this->actingAs($user)->post('/profile/image', [
            'profile_image' => $file,
        ]);

        $response->assertRedirect('/profile');

        $user->refresh();
        $this->assertNotNull($user->profile_image_path);
        Storage::disk('public')->assertExists($user->profile_image_path);
    }
}
