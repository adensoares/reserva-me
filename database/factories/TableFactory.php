<?php

namespace Database\Factories;

use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

class TableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Table::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->unique()->numberBetween(1, 15),
            'seats' => $this->faker->numberBetween(1, 5) * 2, // Gera um número aleatório entre 1 e 5 e multiplica por 2, garantindo um número par.
        ];
    }
}
