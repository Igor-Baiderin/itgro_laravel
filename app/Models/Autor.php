<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Autor extends Model
{
    /** @use HasFactory<\Database\Factories\AutorFactory> */
    use HasFactory;
    protected $table = 'autors';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'information', 'birthday_at'];

    protected $dates = ['created_at', 'updated_at', 'birthday_at'];

    // Мутатор для чтения поля birthday_at
    public function getBirthdayAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    // Мутатор для записи поля birthday_at
    public function setBirthdayAtAttribute($value)
    {
//        $this->attributes['birthday_at'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        $this->attributes['birthday_at'] = Carbon::parse($value)->format('Y-m-d');
    }

    // Определение связи с книгами
    public function books()
    {
        return $this->hasMany(Book::class, 'author_id');
    }
}
