<?php

namespace App\Models;

use App\Common\Database\ConfigurableTrait;
use Illuminate\Database\Eloquent\Model;
use Tsyama\LaravelSoftDeleteFlag\Traits\SoftDeleteFlagTrait;

class FormsUsers extends Model
{
    use ConfigurableTrait;
    use SoftDeleteFlagTrait;
    protected $table=' forms_users';
    protected $fillable=[
        'id',
        // 'id_form',
        // 'id_answer',
        // 'id_user',
        'answer',
        'other',
        'id_exec',
        'id_dep',
        'id_position',
        'old',
        'id_subject',
        'id_teacher',
        'course',
        'is_anon'
    ];
    const CREATED_AT = 'date';
    protected $dateFormat = 'U';

    public function form()
    {
        return $this->belongsTo(Form::class, 'id');
    }
    public function answer()
    {
        return $this->belongsTo(FormAnswer::class, 'id');
    }
}
