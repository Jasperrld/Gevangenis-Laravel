<?php

namespace Database\Seeders;

use App\Models\Prisoner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrisonerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prisoner::factory()->times(count: 10)->create();
    }
}
