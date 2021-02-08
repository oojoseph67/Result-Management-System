<?php

namespace Database\Factories;

use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolClassFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SchoolClass::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'class' => $this->faker->randomElement(['JSS1', 'JSS2', 'JSS3', 'SS1', 'SS2', 'SS3']),
            //'class' => 'JSS1', 'JSS2'

            // 'class' => [
            //     ['JSS1'],
            //     ['JSS2'],
            //     ['JSS3'],
            //     ['SS1'],
            //     ['SS2'],
            //     ['SS3'],
            // ]
        ];
    }
}
