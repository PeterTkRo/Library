<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
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
        return [
            'name' => fake()->unique()->words(3, true),
            'author' => fake()->name(),
            'ISBN' => fake()->unique()->isbn13(),
            'genre' => fake()->randomElement(Book::GENRES),
            'publishing_house' => fake()->word(),
            'publication_date' => fake()->date(),
        ];
    }
}
