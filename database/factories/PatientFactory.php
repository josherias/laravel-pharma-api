<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;


    private function generatePhoneNumber(){
        $mobileNo = '+256753473842';
        $result  = '';

        for($i = 0; $i < 4; $i++){
            $result .= random_int(0, 9);
        }
        $mobileNoUnique = substr($mobileNo, 0, -4) . $result;

        return $mobileNoUnique;
    }


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'address' => $this->faker->address(),
            'contact' => $this->generatePhoneNumber(),
            'next_of_keen' => $this->faker->name(),
            'next_of_keen_contact' => $this->generatePhoneNumber()
        ];
    }
}
