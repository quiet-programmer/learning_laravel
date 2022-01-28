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

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'phone_number' => $this->faker->phoneNumber,
            'password' => bcrypt("bubbleplay") ,// password
            'remember_token' => Str::random(10),
        ];
    }

    public function defaultUserDetails()
    {
        return $this->state([
            'name' => 'Bobby Joseph',
            'email' => 'godsendjoseph@gmail.com',
        ]);
    }
}
