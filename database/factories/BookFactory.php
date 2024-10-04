<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\Autor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => Autor::factory(),
            'name' => $this->faker->sentence(3),
            'annotation' => $this->faker->paragraph,
            'publication_at' => Carbon::parse($this->faker->date)->format('d-m-Y'),
        ];
    }
}
