<?php

namespace Database\Seeders;

use App\Models\Intervention;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterventionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Intervention::factory(10)->create();
    }
}
