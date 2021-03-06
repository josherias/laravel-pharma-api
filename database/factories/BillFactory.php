<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\Category;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bill::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'quantity' => $this->faker->randomNumber($nbDigits = 3),
        'ammount' => $this->faker->randomNumber($nbDigits = 7),
        'patient_id' => Patient::all()->random()->id,
        'patient_name' => Patient::all()->random()->name,
        'category_id' => Category::all()->random()->id,
        'category_name' => Category::all()->random()->name
        ];
    }
}
