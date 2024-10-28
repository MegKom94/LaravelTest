<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'forms';
    //protected $fillable = ['text'];
    public $timestamps = false;
    protected $text = 'text';
    public function form_type()
    {
        return $this->belongsTo(FormType::class, 'id_type');
    }
    public function get(){
        return $this->where()
    }
    public function answers()
    {
        return $this->hasMany(FormAnswer::class, 'id_form');
    }
}
