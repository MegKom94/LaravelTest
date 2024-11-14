<?php

namespace App\Models;

use App\Common\Database\ConfigurableTrait;
use App\Common\Database\mySoftDeleteFlagTrait;
use DB;
use Illuminate\Database\Eloquent\Model;
use Tsyama\LaravelSoftDeleteFlag\Traits\SoftDeleteFlagTrait;

class Form extends Model
{
     //для сортировки. фильтров, пагинации и т.д.
     use ConfigurableTrait;
     //библиотека котрая делает мягкое удаление, написаная
     use MySoftDeleteFlagTrait;

    protected $table = 'forms';
    protected $fillable = [
        'id',
        'text',
        'weight',
        'mnogo',
        'is_use',
        'is_show',
        'is_other',
        'is_subject',
        'link',
        'is_konkurs',
        'id_site',
        'is_deleted'
    ];
    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_update';
    //форматт дат Юнихподобные
    protected $dateFormat = 'U';
    
    //замняет стндарный is_deleted
    const DELETED_AT = 'is_deleted';
    //обратная связь
    public function form_type()
    {
        return $this->belongsTo(FormType::class, 'id_type');
    }
    public function all_answers_users()
    {
        return $this->hasMany(FormsUsers::class, 'id_form');
    }
    public function answers()
    {
        return $this->hasMany(FormAnswer::class, 'id_form');
    }
}
