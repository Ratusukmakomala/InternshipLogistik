<?php

namespace Database\Factories;

use App\Models\Office;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Office>
 */
class OfficeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => null,
            'code' => $this->faker->unique()->numerify('OFF###'),
            'name' => $this->faker->company,
            'region' => $this->faker->numberBetween(1, 6),
            'type' => $this->faker->randomElement(['KCU', 'KC', 'KCP']),
            'address' => $this->faker->address,
            'zip_code' => $this->faker->postcode,
        ];
    }

    /**
     * Indicate that the office is of type KCU.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function kcu()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'KCU',
                'parent_id' => null,
            ];
        });
    }

    /**
     * Indicate that the office is of type KC.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function kc()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'KC',
            ];
        })->afterCreating(function (Office $office) {
            $kcu = Office::factory()->kcu()->create();
            $office->update(['parent_id' => $kcu->id]);
        });
    }

    /**
     * Indicate that the office is of type KCP.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function kcp()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'KCP',
            ];
        })->afterCreating(function (Office $office) {
            $kc = Office::factory()->kc()->create();
            $office->update(['parent_id' => $kc->id]);
        });
    }
}
