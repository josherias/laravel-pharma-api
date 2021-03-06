<?php

namespace Database\Factories;

use App\Models\Diagnosis;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiagnosisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Diagnosis::class;

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
        'blood_pressure' => $this->faker->randomNumber(),
        'pulse_rate' => $this->faker->randomNumber(),
        'respiratory_rate' => $this->faker->randomNumber(),
        'temperature' => $this->faker->randomNumber(),
        'random_blood_sugar' => $this->faker->randomNumber(),
        'saturation_urine_output' => $this->faker->randomNumber(),
        'gcs' => $this->faker->word(),
        'investigation_plan' => $this->faker->paragraph(3),
        'final_diagnosis' => $this->faker->paragraph(3),
        'general_examination' => $this->faker->paragraph(3),
        'cardiovascular_examination' => $this->faker->paragraph(3),
        'abdominal_examination' => $this->faker->paragraph(3),
        'respiratoty_examination' => $this->faker->paragraph(3),
        'central_nervous_examination' => $this->faker->paragraph(3),
        'musculo_skeletal_examination' => $this->faker->paragraph(3),
        'skin_examination' => $this->faker->paragraph(3),
        'treatment_plan' => $this->faker->paragraph(3),
        ];
    }
}
