<?php

namespace App\Http\Controllers;

use DB;
use App\Models\FormType;

class FormTypeController extends Controller
{
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
