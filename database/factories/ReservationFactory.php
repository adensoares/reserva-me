<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'table_id' => Table::factory(),
            'start_time' => $this->faker->dateTimeBetween('18:00', '23:59'),
            'end_time' => $this->faker->dateTimeBetween('18:00', '23:59'),
        ];
    }
}
