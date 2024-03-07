<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Locations_language>
 */
class Locations_languageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location_id' => fake()->numberBetween(1, Location::count()),
            'language' => fake()->languageCode(),
            'hours' => fake()->text(),
            'info' => fake()->text(),
        ];
    }
}
