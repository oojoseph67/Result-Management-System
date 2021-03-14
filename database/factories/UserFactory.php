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

        $class = $this->faker->randomElement(['JSS1', 'JSS2', 'JSS3', 'SS1', 'SS2', 'SS3']);

        return [
            [
                'name' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail,
                'dob' => $this->faker->dateTimeBetween($startDate = '-20 years', $endDate = '-10 years'),
                'entry_class' => $class,
                'current_class' => $class,
                'session' => '2020/2021',
                'term' => 'First Term',
                'role' => 'student',
                'passport_path' => $this->faker->imageUrl(640, 480),
                'email_verified_at' => now(),
                'password' =>  bcrypt('password'), // password
                'remember_token' => Str::random(10),
            ],

            [
                'name' => $this->faker->name(),
                'email' => 'tec@rms.com',
                'dob' => $this->faker->dateTimeBetween($startDate = '-50 years', $endDate = '-20 years'),
                'session' => '2020/2021',
                'term' => 'First Term',
                'role' => 'teacher',
                'passport_path' => $this->faker->imageUrl(640, 480),
                'email_verified_at' => now(),
                'password' =>  bcrypt('password'), // password
                'remember_token' => Str::random(10),
            ],

            

        ];
    }
}
