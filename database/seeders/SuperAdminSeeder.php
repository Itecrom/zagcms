<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Leonard Mhone',
            'email' => 'leonardjjmhone@gmail.com', // change to your real email
            'password' => Hash::make('110588'), // set a strong password
            'role' => 'super_admin', // assuming you have a role column
        ]);
    }
}
