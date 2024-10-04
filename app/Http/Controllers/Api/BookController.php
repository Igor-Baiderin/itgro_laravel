<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Метод для получения списка книг с пагинацией
    public function index(Request $request)
    {
        // Получаем книги с информацией об авторе и применяем пагинацию
        $books = Book::with('autor') // Загружаем информацию об авторе
        ->paginate(10); // Пагинация, 10 книг на страницу

        return response()->json($books);
    }

    // Метод для создания книги
    public function store(StoreBookRequest $request)
    {
        $book = Book::create([
            'author_id' => $request->author_id,
            'name' => $request->name,
            'annotation' => $request->annotation,
            'publication_at' => $request->publication_at ? \Carbon\Carbon::createFromFormat('d-m-Y', $request->publication_at)->format('Y-m-d') : null,
        ]);

        return response()->json($book, 201);
    }

    // Метод для получения книги по ID с информацией об авторе
    public function show($id)
    {
        $book = Book::with('autor')->findOrFail($id); // Загружаем книгу с информацией об авторе
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     */
    // Метод для редактирования книги
    public function update(StoreBookRequest $request, $id)
    {
        $book = Book::findOrFail($id);

        $book->update([
            'author_id' => $request->author_id,
            'name' => $request->name,
            'annotation' => $request->annotation,
            'publication_at' => $request->publication_at,
        ]);

        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
