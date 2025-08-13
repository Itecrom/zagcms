<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Homecell;
use App\Models\Ministry;

class StaticChurchDataSeeder extends Seeder
{
    public function run(): void
    {
        $homecells = ['Mulunguzi','Kalimbuka','Old Naisi','Matawale','St. Marys','Jerusalem','Mpunga','Likangala','Chikanda','Chanco','Atlarge'];
        foreach ($homecells as $h) Homecell::firstOrCreate(['name'=>$h]);

        $ministries = ['Menz','OMC','Youth','Children'];
        foreach ($ministries as $m) Ministry::firstOrCreate(['name'=>$m]);
    }
}
