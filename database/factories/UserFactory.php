<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    private $password;


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
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $this->password ?: $this->password = bcrypt('secret'),
            'contact' => $this->generatePhoneNumber(),
            'designation' => $this->faker->jobTitle(),
            'image' => $this->faker->randomElement(['1.jpg', '2.jpg', '3.jpg']),
            'admin' => $this->faker->randomElement([User::ADMIN_USER, User::REGULAR_USER]),
            'verified' => $verified = $this->faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]),
            'verification_token' => $verified == User::VERIFIED_USER ? null : User::generateVerificationToken(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
