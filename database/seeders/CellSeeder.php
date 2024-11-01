<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cell;
use App\Models\Prisoner;

class CellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prisoner::all()->each(function ($prisoner) {
            $cell = Cell::factory()->create(['prisoner_id' => $prisoner->id]);
            $prisoner->update(['cel_id' => $cell->id]);
        });
    }
}
