<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAutorRequest;
use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    // Метод для получения всех авторов
    public function index()
    {
        // Получаем авторов, сортируя по количеству книг и используя пагинацию
        $autors = Autor::withCount('books') // Подсчитываем количество книг для каждого автора
        ->orderBy('books_count', 'desc') // Сортируем по количеству книг
        ->paginate(15); // Пагинация, 15 авторов на страницу

        return response()->json($autors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAutorRequest $request)
    {
        $autor = Autor::create([
            'name' => $request->name,
            'information' => $request->information,
            'birthday_at' => $request->birthday_at ? \Carbon\Carbon::createFromFormat('d-m-Y', $request->birthday_at)->format('Y-m-d') : null,
        ]);

        return response()->json($autor, 201);
    }

    /**
     * Display the specified resource.
     */
    // Метод для получения автора по ID
    // Метод для получения автора по ID с добавленными книгами
    public function show($id)
    {
        $autor = Autor::with('books')->findOrFail($id); // Загружаем автора с книгами
        return response()->json($autor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAutorRequest $request, $id)
    {
        $autor = Autor::findOrFail($id);

        $autor->update([
            'name' => $request->name,
            'information' => $request->information,
            'birthday_at' => $request->birthday_at ? \Carbon\Carbon::createFromFormat('d-m-Y', $request->birthday_at)->format('Y-m-d') : null,
        ]);

        return response()->json($autor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
