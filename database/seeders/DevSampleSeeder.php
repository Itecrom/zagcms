<?php

namespace Database\Seeders;

use App\Models\Homecell;
use App\Models\Ministry;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DevSampleSeeder extends Seeder
{
    public function run(): void
    {
        $mulunguzi = Homecell::firstOrCreate(['name' => 'Mulunguzi']);
        $youth     = Ministry::firstOrCreate(['name' => 'Youth']);

        User::firstOrCreate(['email' => 'super@zag.com'], [
            'name' => 'Super Admin',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
        ]);

        User::firstOrCreate(['email' => 'pastor@zag.com'], [
            'name' => 'Homecell Pastor',
            'password' => Hash::make('password'),
            'role' => 'homecell_pastor',
            'homecell_id' => $mulunguzi->id,
        ]);

        User::firstOrCreate(['email' => 'leader@zag.com'], [
            'name' => 'Ministry Leader',
            'password' => Hash::make('password'),
            'role' => 'ministry_leader',
            'ministry_id' => $youth->id,
        ]);
    }
}
