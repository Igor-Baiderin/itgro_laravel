<?php

use App\Http\Controllers\Api\AutorController;
use App\Http\Controllers\Api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('/autors', AutorController::class)->only(['index', 'show', 'store', 'update']);
Route::resource('/books', BookController::class)->only(['index', 'show', 'store', 'update']);
