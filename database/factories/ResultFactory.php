<?php

namespace Database\Factories;

use App\Models\Result;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Result::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = function () {
            if (User::count())
                return $this->faker->randomElement(User::where('role', 'student')->pluck('name')->toArray());
            else return User::factory()->create()->id;
        };

        $class = function () {
            if (User::count())
                return $this->faker->randomElement(User::where('role', 'student')->pluck('current_class')->toArray());
            else return User::factory()->create()->id;
        };

        $subject_name = function () {
            if (Subject::count())
                return $this->faker->randomElement(Subject::pluck('subject_name')->toArray());
            else return Subject::factory()->create()->id;
        };

        $attendance_score = $this->faker->numberBetween(0, 5);

        $first_test = $this->faker->numberBetween(0, 10);

        $second_test = $this->faker->numberBetween(0, 10);

        $third_test = $this->faker->numberBetween(0, 10);

        $quiz = $this->faker->numberBetween(0, 5);
        
        $exam_score = $this->faker->numberBetween(0, 60);

        $total = $attendance_score + $first_test + $second_test + $third_test + $quiz + $exam_score;

        return [
            // 'name' => function () {
            //     if (User::count())
            //         return $this->faker->randomElement(User::where('role', 'student')->pluck('name')->toArray());
            //     else return User::factory()->create()->id;
            // },
            // 'class' => function () {
            //     if (User::count())
            //         return $this->faker->randomElement(User::where('role', 'student')->pluck('current_class')->toArray());
            //     else return User::factory()->create()->id;
            // },
            // 'subject_name' => function () {
            //     if (Subject::count())
            //         return $this->faker->randomElement(Subject::pluck('subject_name')->toArray());
            //     else return Subject::factory()->create()->id;
            // },
            // 'attendance_score' => $this->faker->numberBetween(0, 5),
            // 'first_test' => $this->faker->numberBetween(0, 10),
            // 'second_test' => $this->faker->numberBetween(0, 10),
            // 'third_test' => $this->faker->numberBetween(0, 10),
            // 'quiz' => $this->faker->numberBetween(0, 5),
            // 'exam_score' => $this->faker->numberBetween(30, 60),
            // 'total' => ,

            'name' => $name,
            'class' => $class,
            'subject_name' => $subject_name,
            'attendance_score' => $attendance_score,
            'first_test' => $first_test,
            'second_test' => $second_test,
            'third_test' =>  $third_test,
            'quiz' => $quiz,
            'exam_score' => $exam_score,
            'total' => $total
        ];
    }
}
