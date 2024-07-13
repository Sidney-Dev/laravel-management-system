<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Project;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // truncate all tables
        DB::table('role_user')->truncate();
        DB::table('roles')->truncate();
        DB::table('users')->truncate();
        DB::table('projects')->truncate();
        DB::table('tasks')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // create admin and developer roles
        $admin_role = Role::factory()->create(['name' => 'admin']);
        $developer_role = Role::factory()->create(['name' => 'developer']);

        // fake a user and assign the admin role
        $admin_user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => null,
            'password' => Hash::make(env('DEFAULT_PASSWORD')),
        ]);
        $admin_user->roles()->attach($admin_role);

        // fake 10 users where each will be a developer
        User::factory(10)->hasAttached($developer_role)->create();

        // fake 5 posts with 10 tasks each
        Project::factory(5)->hasTasks(10)->create();

    }
}
