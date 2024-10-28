<?php

namespace App\Models;
use App\Common\Database\ConfigurableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Tsyama\LaravelSoftDeleteFlag\Traits\SoftDeleteFlagTrait;

class FormType extends Model
{
    use ConfigurableTrait;
    use SoftDeleteFlagTrait;

    protected $table = 'forms_types';
    protected $fillable = [
        'title'
    ];

    //По умолчанию Eloquent ожидает наличия в ваших таблицах столбцов updated_at и created_at, чтобы этого не было нужно прописать false
    // public $timestamps = false;

    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_update';
    protected $dateFormat = 'U';
    const DELETED_AT = 'is_deleted';

    public function forms()
    {
        return $this->hasMany(Form::class, 'id_type');
    }
}

