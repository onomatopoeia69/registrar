<?php

namespace Database\Factories;

use App\Models\Student;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Student::class;


    public function definition(): array
    {
        return [
            'student_number' => $this->faker->unique()->numerify('####'),
            'first_name'     => $this->faker->firstName(),
            'middle_name'      => $this->faker->lastName(),
            'last_name'      => $this->faker->lastName(),
            'gender'         => $this->faker->randomElement(['male', 'female']),
            'course'         => 'BSIT',
            'year_level'     => $this->faker->numberBetween(1, 4),
            'academic_status'  => $this->faker->randomElement(['active','graduated','inactive']),
        ];
    }
}
