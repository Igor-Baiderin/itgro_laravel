<?php

namespace Tests\Feature;

use App\Models\Autor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AutorApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_autor()
    {
        $data = [
            'name' => 'Автор 1',
            'information' => 'Информация об авторе 1',
            'birthday_at' => '01-01-1980',
        ];

        $response = $this->postJson('/api/autors', $data);

        $response->assertStatus(201)
            ->assertJsonFragment($data);
    }

    /** @test */
    public function it_can_get_autors()
    {
        Autor::factory()->count(5)->create();

        $response = $this->getJson('/api/autors');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }

    /** @test */
    public function it_can_get_autor_by_id()
    {
        $autor = Autor::factory()->create();

        $response = $this->getJson('/api/autors/' . $autor->id);

        $response->assertStatus(200)
            ->assertJsonFragment($autor->toArray());
    }

    /** @test */
    public function it_can_update_autor()
    {
        $autor = Autor::factory()->create();
        $data = [
            'name' => 'Обновленный автор',
            'information' => 'Обновленная информация',
            'birthday_at' => '01-01-1985',
        ];

        $response = $this->putJson('/api/autors/' . $autor->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment($data);
    }
}
