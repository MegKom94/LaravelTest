<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAnswer extends Model
{
    protected $table = 'forms_answers';
    public $timestamps = false;
    public function form(){
        return $this->belongsTo(Form::class);
    }
}
