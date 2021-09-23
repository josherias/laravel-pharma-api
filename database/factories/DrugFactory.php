<?php

namespace Database\Factories;

use App\Models\Drug;
use Illuminate\Database\Eloquent\Factories\Factory;

class DrugFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Drug::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(1),
            'quantity' => $this->faker->randomDigit(),
            'price' => $this->faker->randomNumber(5),
            'expiry_date' => $this->faker->date('Y-m-d', 'now'),
            'dosage' => $this->faker->randomDigit()
        ];
    }
}
