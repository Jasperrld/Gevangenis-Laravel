<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prisoner>
 */
class PrisonerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->word(),
            "arrestatiereden" => $this->faker->word(),
            "BSN_nummer" => $this->faker->numberBetween(100000000, 999999999),
            "adres" => $this->faker->word(),
            "woonplaats" => $this->faker->word(),
            "datumarrestatie" => $this->faker->date(),
            "zaak_id" => null,
            'cel_id' => null, // Initially null, to be updated later
            "insluitingsdatum" => now(),
            "uitsluitingsdatum" => now()->addDay(10),
            "maatschappelijke_aantekeningen" => $this->faker->paragraph(),
            "location_id" => null,
        ];
    }
}
