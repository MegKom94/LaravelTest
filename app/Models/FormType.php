<?php

namespace App\Models;
use App\Common\Database\ConfigurableTrait;
use Illuminate\Database\Eloquent\Model;
use Tsyama\LaravelSoftDeleteFlag\Traits\SoftDeleteFlagTrait;

class FormType extends Model
{
    //для сортировки. фильтров, пагинации и т.д.
    use ConfigurableTrait;
    //библиотека котрая делает мягкое удаление
    use SoftDeleteFlagTrait;

    protected $table = 'forms_types';
    //все поля котрые должны охранятся
    protected $fillable = [
        'id',
        'title',
        'description',
        'is_student',
        'is_empl',
        'is_opros',
        'id_site',
        'weight',
        'is_subject',
        'id_dep',
        'answer_type'
    ];
    public $timestamps = false;
    //форматт дат Юнихподобные
    protected $dateFormat = 'U';
    //замняет стндарный is_deleted
    const DELETED_AT = 'is_deleted';
    //связи
    public function forms()
    {
        return $this->hasMany(Form::class, 'id_type');
    }
}

