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
        $status = $this->faker->randomElement(['active', 'graduated', 'inactive']);

        $createdAt = $this->faker->dateTimeBetween('-4 years', '-1 month');

        return [
            'student_number' => $this->faker->unique()->numerify('####'),
            'first_name'     => $this->faker->firstName(),
            'middle_name'    => $this->faker->lastName(),
            'last_name'      => $this->faker->lastName(),
            'gender'         => $this->faker->randomElement(['male', 'female']),
            'course'         => $this->faker->randomElement(['BSIS','BSCrim','BSTM','BSAIS']),
            'year_level'     => $status === 'graduated'
                                ? 4
                                : $this->faker->numberBetween(1, 4),
            'academic_status' => $status, 

            'graduated_at' => $status === 'graduated'
                ? $this->faker->dateTimeBetween($createdAt, 'now')
                : null,

            'created_at' => $createdAt,
            'updated_at' => now(),
        ];
    }

}
