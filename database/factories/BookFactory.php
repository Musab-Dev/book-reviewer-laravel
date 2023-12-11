<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created_at_date =  fake()->dateTimeBetween('-2 years', 'now');
        return [
            'isbn' => fake()->isbn10,
            'title' => fake()->sentence,
            'author' => fake()->name,
            'created_at' => $created_at_date,
            'updated_at'=> fake()->dateTimeBetween($created_at_date,'now'),
        ];
    }
}
