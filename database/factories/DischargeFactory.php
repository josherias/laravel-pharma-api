<?php

namespace Database\Factories;

use App\Models\Discharge;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DischargeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Discharge::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
        'patient_id' => Patient::all()->random()->id,
        'patient_name' => Patient::all()->random()->name,
        'doctor_id' => User::all()->random()->id,
        'doctor_name' => User::all()->random()->name,
        'initial_diagnosis' => $this->faker->paragraph(1),
        'investigation_plan' => $this->faker->paragraph(1),
        'discharge_plan' => $this->faker->paragraph(1),
        'patient_condition' => $this->faker->paragraph(1),
        'final_diagnosis' => $this->faker->paragraph(1),
        'treatment_summary' => $this->faker->paragraph(1),
        'clinical_summary' => $this->faker->paragraph(2),
        'next_appointment' => $this->faker->dateTime($max = 'now', $timezone = null)
        ];
    }
}
