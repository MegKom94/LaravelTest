<?php

namespace App\Models;
use App\Common\Database\ConfigurableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FormType extends Model
{
    use ConfigurableTrait;
    use SoftDeletes;

    protected $table = 'forms_types';
    protected $fillable = [
        'title'
    ];

    //По умолчанию Eloquent ожидает наличия в ваших таблицах столбцов updated_at и created_at, чтобы этого не было нужно прописать false
    // public $timestamps = false;

    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_update';
    protected $dateFormat = 'U';

    public function forms()
    {
        return $this->hasMany(Form::class, 'id_type');
    }
}

