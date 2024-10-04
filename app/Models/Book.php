<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    protected $table = 'books';
    protected $guarded = ['id'];
    protected $fillable = ['author_id', 'name', 'annotation', 'publication_at'];

    // Мутатор для чтения поля publication_at
    public function getPublicationAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    // Мутатор для записи поля publication_at
    public function setPublicationAtAttribute($value)
    {
        $this->attributes['publication_at'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    // Определение связи с автором
    public function autor()
    {
        return $this->belongsTo(Autor::class, 'author_id'); // Указание имени колонки
    }
}
