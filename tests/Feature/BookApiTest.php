<?php

namespace Tests\Feature;

use App\Models\Autor;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_book()
    {
        $autor = Autor::factory()->create();

        $data = [
            'author_id' => $autor->id,
            'name' => 'Книга 1',
            'annotation' => 'Аннотация к книге 1',
            'publication_at' => '01-01-2020',
        ];

        $response = $this->postJson('/api/books', $data);

        $response->assertStatus(201)
            ->assertJsonFragment($data);
    }

    #[Test]
    public function it_can_get_books()
    {
        Book::factory()->count(5)->create();

        $response = $this->getJson('/api/books');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }

    #[Test]
    public function it_can_get_book_by_id()
    {
        $book = Book::factory()->create();

        $response = $this->getJson('/api/books/' . $book->id);

        $response->assertStatus(200)
            ->assertJsonFragment($book->toArray());
    }

    #[Test]
    public function it_can_update_book()
    {
        $autor = Autor::factory()->create();
        $book = Book::factory()->create();

        $data = [
            'author_id' => $autor->id,
            'name' => 'Обновленная книга',
            'annotation' => 'Обновленная аннотация',
            'publication_at' => '01-01-2021',
        ];

        $response = $this->putJson('/api/books/' . $book->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment($data);
    }
}
