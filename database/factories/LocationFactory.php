<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'street' => $this->faker->streetName(),
            'street_number' => $this->faker->buildingNumber(),
            'postcode' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'hours' => $this->faker->text(),
            'capacity' => $this->faker->numberBetween(1, 100),
            'info' => $this->faker->text(),
            'is_reservation_mandatory' => $this->faker->boolean(),
            'image_path' => $this->faker->imageUrl(),
            'reservation_link' => $this->faker->url(),
        ];
    }
}
