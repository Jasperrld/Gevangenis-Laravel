<?php

namespace Database\Seeders;

use App\Models\PrisonCase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrisonCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrisonCase::factory()->times(count: 10)->create();

    }
}
