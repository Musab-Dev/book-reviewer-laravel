<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Book::factory()->count(33)->create()->each(
            function ($book) {
                $numberOfReviews = random_int(5, 30);

                Review::factory()
                    ->count($numberOfReviews)
                    ->initializeDates($book)
                    ->good()
                    ->for($book)
                    ->create();
            }
        );

        Book::factory()->count(33)->create()->each(
            function ($book) {
                $numberOfReviews = random_int(5, 10);

                Review::factory()
                    ->count($numberOfReviews)
                    ->initializeDates($book)
                    ->average()
                    ->for($book)
                    ->create();
            }
        );

        Book::factory()->count(34)->create()->each(
            function ($book) {
                $numberOfReviews = random_int(5, 10);

                Review::factory()
                    ->count($numberOfReviews)
                    ->initializeDates($book)
                    ->bad()
                    ->for($book)
                    ->create();
            }
        );

    }
}
