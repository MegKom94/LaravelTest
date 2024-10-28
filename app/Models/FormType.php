<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormType extends Model
{
    protected $table = 'forms_types';
    protected $fillable = [
        'title'
    ];

    //По умолчанию Eloquent ожидает наличия в ваших таблицах столбцов updated_at и created_at, чтобы этого не было нужно прописать false
    public $timestamps = false;
    public function forms()
    {
        return $this->hasMany(Form::class, 'id_type');
    }
}

