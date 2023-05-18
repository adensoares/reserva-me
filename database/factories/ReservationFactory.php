<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Table;
use Carbon\Carbon;
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
            'reservation_time' => Carbon::now()->addDay(),
        ];
    }
}
