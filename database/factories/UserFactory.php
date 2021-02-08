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
        // return [
        //     'name' => $this->faker->name,
        //     'email' => $this->faker->unique()->safeEmail,
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ];

        return [
            // 'name' => $this->faker->name,
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail,
            'dob' => $this->faker->date(),
            'entry_class' => $this->faker->randomElement(['JSS1', 'JSS2', 'JSS3', 'SS1', 'SS2', 'SS3']),
            'current_class' => $this->faker->randomElement(['JSS1', 'JSS2', 'JSS3', 'SS1', 'SS2', 'SS3']),
            'role' => $this->faker->randomElement(['data-operator', 'teacher', 'student']),
            'passport_path' => $this->faker->imageUrl(640, 480),
            'email_verified_at' => now(),
            'password' =>  bcrypt('password'), // password
            'remember_token' => Str::random(10),

        ];
    }
}
