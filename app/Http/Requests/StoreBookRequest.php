<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Разрешить доступ
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'author_id' => 'required|exists:autors,id', // Проверка на существование автора
            'name' => 'required|string|min:2|max:100',
            'annotation' => 'nullable|string|max:1000',
            'publication_at' => 'required|date_format:d-m-Y', // Формат даты дд-мм-гггг
        ];
    }
}
