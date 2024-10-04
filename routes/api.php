<?php

use App\Http\Controllers\Api\AutorController;
use App\Http\Controllers\Api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/autors', [AutorController::class, 'index']); // Получение всех авторов
Route::get('/autors/{id}', [AutorController::class, 'show']); // Получение автора по ID
Route::post('/autors', [AutorController::class, 'store']); // Создание автора
Route::put('/autors/{id}', [AutorController::class, 'update']); // Обновление автора

Route::get('/books/{id}', [BookController::class, 'show']); // Получение книги по ID
Route::get('/books', [BookController::class, 'index']); // Получение списка книг
Route::post('/books', [BookController::class, 'store']); // Создание книги
Route::put('/books/{id}', [BookController::class, 'update']); // Обновление книги
