<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Subject>
     */
    protected $model = Subject::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Mathematics', 'English', 'Science', 'Social Studies', 'Art', 'Music', 'PE']),
            'code' => fake()->unique()->regexify('[A-Z]{3,4}'),
            'description' => fake()->sentence(),
            'credits' => fake()->numberBetween(1, 5),
        ];
    }
}