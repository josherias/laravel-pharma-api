<?php

namespace Database\Factories;

use App\Models\Formulation;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormulationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Formulation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->paragraph(2)
        ];
    }
}
