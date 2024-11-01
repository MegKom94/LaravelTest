<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Transformers\v0\FormTypeTransformer;
use App\Http\Controllers\Controller;
use App\Models\FormType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FormTypeController extends Controller
{
    //вернет список FormType
    public function list()
    {
        $forms_types = FormType::get();
        //возвращает трансформируемый объект (объект котрый нужно трансформировать(любой))
        return new FormTypeTransformer($forms_types, []);
    }
    public function get(FormType $form_type)
    {
       return new FormTypeTransformer($form_type, []);
    }
    public function listQuestions(FormType $form_type)
    {
        // $forms = $form_type->forms;
        // return new FormTransformer($forms, []);
        //возвращает трансформируемый объект (объект котрый нужно трансформировать(любой), формы чтобы добавить вопросы к форме)
        return new FormTypeTransformer($form_type, ['forms']);
    }
    //Связь один ко многим с моделью FormType по id=1
    public function connection(){
        $result = FormType::find(1)->form;
        dd($result);

    }
    public function create(Request $request, FormType $form_type)
    {
        $form = $request->validate([
            'title'=> ['required','max:255', 'string'],
            'description'=> ['required', 'max:255', 'string'],
            'is_stydent'=> ['required', Rule::in(0,1), 'integer'],
            //'is_stydent'=> ['nullable', Rule::in(0,1)],
            //заполнение всех полей значениями, обязательно! чтобы не было ошибок
            'is_empl'=> ['required',Rule::in(0,1), 'integer'],
            'is_opros'=> ['required',Rule::in(0,1), 'integer'],
            'id_site'=> ['required',Rule::in(0,1), 'integer']
        ]);
        $form_type->fill($form);
        $form_type->save();
        
        return $this->ok();     
    }
    public function edit(Request $request, FormType $form_type)
    {
        $form = $request->validate([
            'title'=> ['required','max:255', 'string'],
            'description'=> ['required', 'max:255', 'string'],
            'is_stydent'=> ['required', Rule::in(0,1), 'integer'],
            'is_empl'=> ['required',Rule::in(0,1), 'integer'],
            'is_opros'=> ['required',Rule::in(0,1), 'integer'],
            'id_site'=> ['required',Rule::in(0,1), 'integer']
        ]);
        $form_type->fill($form);
        $form_type->save();
        
        return $this->ok();     
    }
    public function createX()
    {
        $new_Form_Type = new FormType();
        $new_Form_Type->fill(array(
            'title' => $_POST['title'],
            'description' => $_POST['description'],
        ));
        if (isset($_POST['radio1']) == true) {
            $new_Form_Type->is_opros = 1;
            $new_Form_Type->is_student = 1;
            $new_Form_Type->is_empl = 1;
            echo ('Был выбран 1');
        } else {
            if (isset($_POST['radio2']) == true) {
                $new_Form_Type->is_student = 1;
                echo ('Был выбран 2');
            }
            if (isset($_POST['radio3']) == true) {
                $new_Form_Type->is_empl = 1;
                echo ('Был выбран 3');
            }
        }
        $new_Form_Type->save();
        return $this->ok();
    }
}
