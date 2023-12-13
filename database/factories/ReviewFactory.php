<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment'  => fake()->paragraph(7, true),
            'rating' => random_int(1,5),
        ];
    }

    public function initializeDates(Book $book) {
        return $this->state(function (array $attributes) use ($book){
            $bookCreationDate = $book->created_at;
            $reviewCreationDate = fake()->dateTimeBetween($bookCreationDate, 'now');
            return [
                'created_at' => $reviewCreationDate,
                'updated_at' => fake()->dateTimeBetween($reviewCreationDate, 'now'),
            ];
        });
    }

    public function good(){
        return $this->state(function (array $attributes) {
            return [
                'rating' => random_int(4,5),
            ];
        });
    }

    public function average(){
        return $this->state(function (array $attributes) {
            return [
                'rating' => random_int(3,4),
            ];
        });
    }

    public function bad(){
        return $this->state(function (array $attributes) {
            return [
                'rating' => random_int(1,2),
            ];
        });
    }
}
