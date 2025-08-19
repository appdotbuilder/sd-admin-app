<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SchoolSystemTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_dashboard_requires_authentication(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_dashboard(): void
    {
        $role = Role::factory()->create(['name' => 'student']);
        $user = User::factory()->create(['role_id' => $role->id]);

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
    }

    public function test_roles_can_be_created(): void
    {
        $role = Role::factory()->create([
            'name' => 'teacher',
            'display_name' => 'Teacher',
            'description' => 'Can manage classes and students'
        ]);

        $this->assertDatabaseHas('roles', [
            'name' => 'teacher',
            'display_name' => 'Teacher'
        ]);
    }

    public function test_user_can_have_role(): void
    {
        $role = Role::factory()->create(['name' => 'administrator']);
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->assertTrue($user->hasRole('administrator'));
        $this->assertFalse($user->hasRole('teacher'));
    }
}