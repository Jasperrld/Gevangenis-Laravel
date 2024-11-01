<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visit>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "prisoner_id" => null,
            'visitor_id' => null, // Initially null, to be updated later
            'location_id' => null, // Initially null, to be updated later
            "bezoekdatum" => now(),
            "tijd_in" => now(),
            "tijd_uit" => now(),
        ];
    }
}
