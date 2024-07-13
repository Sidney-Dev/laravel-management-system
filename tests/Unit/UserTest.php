<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_user()
    {
        // Create a role and an admin user
        $admin_role = Role::factory()->create(['name' => 'admin']);
        $admin_user = User::factory()->create();
        $admin_user->roles()->attach($admin_role);

        $response = $this->actingAs($admin_user)
            ->post("/dashboard/users", [
                "name" => "Developer",
                "email" => "developer@example.com",
                "role" => $admin_role->id,
            ]);

        $response->assertRedirect(route('users.index'));

        // Assert the user was created
        $this->assertDatabaseHas('users', ['email' => 'developer@example.com']);
        $this->assertDatabaseHas('role_user', [
            'user_id' => User::where('email', 'developer@example.com')->first()->id,
            'role_id' => $admin_role->id,
        ]);
    }
}
