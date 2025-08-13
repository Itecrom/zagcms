<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Leonard Mhone',
            'email' => 'leonardjjmhone@gmail.com',
            'password' => bcrypt('110588'),
            'role' => 'super_admin',
        ]);
    }
}
