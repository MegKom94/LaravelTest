<?php

namespace App\Models;

use App\Common\Database\ConfigurableTrait;
use Illuminate\Database\Eloquent\Model;
use Tsyama\LaravelSoftDeleteFlag\Traits\SoftDeleteFlagTrait;

class Form extends Model
{
     //для сортировки. фильтров, пагинации и т.д.
     use ConfigurableTrait;
     //библиотека котрая делает мягкое удаление
     use SoftDeleteFlagTrait;
 
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
    //связи
    public function answers()
    {
        return $this->hasMany(FormAnswer::class, 'id_form');
    }
}
