<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormAnswer;

class FormAnswerController extends Controller
{
    public function index(){
        $forms = FormAnswer::get();
        dd($forms[1]);
    }

    //Связь один ко многим с моделью Form по id=1
    public function connection(){
        $result = Form::find(1)->form_answer;
        dd($result);
    }
}
