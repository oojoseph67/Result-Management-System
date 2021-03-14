<?php

namespace Database\Factories;

use App\Models\AssignTeacher;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AssignTeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssignTeacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'teacher_name' => function () {
                if (User::count())
                    // return $this->faker->randomElement(DB::table('users')->select('name')->where('role', 'teacher')->get());
                    return $this->faker->randomElement(User::where('role', 'teacher')->pluck('name')->toArray());
                else return User::factory()->create()->id;
            },
            'subject_name' => function () {
                if (Subject::count())
                    return $this->faker->randomElement(Subject::pluck('subject_name')->toArray());
                else return Subject::factory()->create()->id;
            },
            'class' => function () {
                if (Subject::count())
                    return $this->faker->randomElement(Subject::pluck('class')->toArray());
                else return Subject::factory()->create()->id;
            },
        ];

    }
}
