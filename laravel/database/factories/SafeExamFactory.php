<?php

namespace Database\Factories;

use App\Models\SafeExam;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SafeExam>
 */
class SafeExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'classroom' => fake()->word(),
            'url' => fake()->url(),
            'token' => SafeExam::new_token(),
            'quit_password' => SafeExam::new_quit_password(),
            'user_id' => User::factory()->create()
        ];
    }
}
