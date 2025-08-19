<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run() {
        Role::insert([
            ['name' => 'super_admin'],
            ['name' => 'homecell_pastor'],
            ['name' => 'ministry_leader'],
        ]);
    }
}
