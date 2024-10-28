<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Transformers\v0\FormTypeTransformer;
use DB;
use App\Http\Controllers\Controller;
use App\Http\Transformers\v0\FormTransformer;
use App\Models\FormType;

class FormTypeController extends Controller
{
    public function list()
    {
        $forms = FormType::get();
        return new FormTypeTransformer($forms, []);
    }
    public function get(FormType $form_type)
    {
       return new FormTypeTransformer($form_type, []);
    }
    public function listQuestions(FormType $form_type)
    {
        // $forms = $form_type->forms;
        // return new FormTransformer($forms, []);
        return new FormTypeTransformer($form_type, ['forms']);
    }
    public function index()
    {
        $forms = FormType::get();
        // $result = DB::select('SELECT forms_types.title, forms.text, forms_answers.text
        //                 FROM forms
        //                 JOIN forms_types on forms_types.id=forms.id_type
        //                 JOIN forms_answers on forms_answers.id_form = forms.id');
        dd($forms[0]);
    }
    //Связь один ко многим с моделью FormType по id=1
    public function connection(){
        $result = FormType::find(1)->form;
        dd($result);

    }
}
