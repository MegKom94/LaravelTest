<?php

namespace App\Models;

use App\Common\Database\ConfigurableTrait;
use Illuminate\Database\Eloquent\Model;

class FormAnswer extends Model
{
    protected $fillable = [
        'text',
        'is_field'
    ];
     //для сортировки. фильтров, пагинации и т.д.
     use ConfigurableTrait;
     protected $dateFormat = 'U';
    protected $table = 'forms_answers';
    //По умолчанию Eloquent ожидает наличия в ваших таблицах столбцов updated_at и created_at, чтобы этого не было нужно прописать false
    public $timestamps = false;
    public function form(){
        return $this->belongsTo(Form::class,'id_form');
    }
    public function answers_users()
    {
        return $this->hasMany(FormsUsers::class, 'id_answer');
    }
}
