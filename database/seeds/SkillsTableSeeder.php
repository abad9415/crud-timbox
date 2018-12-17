<?php

use Illuminate\Database\Seeder;
use App\Skills;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skills::create(['name' => 'Liderazgo']);
        Skills::create(['name' => 'Trabajo en equipo']);
        Skills::create(['name' => 'Autodidacta']);
        Skills::create(['name' => 'Proactivo']);
        Skills::create(['name' => 'Analista']);
    }
}
