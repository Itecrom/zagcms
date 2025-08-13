<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // First, seed roles
        $this->call(RolesSeeder::class);

        // Create a test user
        $user = User::factory()->create([
            'name' => 'Leonard',
            'email' => 'leonardmhone@gmail.com',
            'password' => bcrypt('110588'), // password: password
        ]);

        // Assign Superadmin role
        $superAdminRole = Role::where('name', 'Superadmin')->first();
        if ($superAdminRole) {
            $user->assignRole($superAdminRole);
        }
    }
}
