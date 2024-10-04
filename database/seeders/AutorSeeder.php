<?php

namespace Database\Seeders;
use App\Models\Autor;
use App\Models\Book;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Autor::factory()
            ->count(100)
            ->has(Book::factory()->count(rand(3, 30))) // Each author has between 3 and 30 books
            ->create();
    }
}
