<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code'      => generateRandomCode(10),
            'name'      => $this->faker->name,
            'phone'     => $this->faker->phoneNumber,
            'address'   => $this->faker->address,
            'zip_code'  => $this->faker->postcode,
        ];
    }
}
