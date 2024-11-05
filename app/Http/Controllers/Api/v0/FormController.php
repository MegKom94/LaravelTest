<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use App\Http\Transformers\v0\FormTransformer;
use App\Models\Form;
use App\Models\FormType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FormController extends Controller
{
    public function list(){
        $question=Form::get();
        return new FormTransformer($question,[]);
    }
    //получение результата запроса на получение списка вопросов по заголовку
    public function get(Form $form)
    {
        return new FormTransformer($form,[]);
    }

    public function create(Request $request, Form $form)
    {
        $question = $this->validateForm($request);
        $form->fill($question);
        $form->form_type()->associate($question['id_type']);
        $form->save();

        return $this->ok();
    }
    public function edit(Request $request, Form $form)
    {
        $question = $this->validateForm($request);
        $form->fill($question);
        $form->form_type()->associate($question['id_type']);
        $form->save();

        return $this->ok();
    }
    public function statistics(Request $request, Form $form)
    {
        
    }
    public function listAnswers(Form $form)
    {
        return new FormTransformer($form,['answers']);
    }
    // public function delete(Form $form)
    // {
        
    //     return $this->ok();
    // }
    protected function validateForm($request)
    {
        return $request->validate([
            'text' => ['required','max:255','string'],
            'id_type' => ['required','integer'],
            // 'weight'=> ['integer','required'],
            // 'mnogo'=> ['integer','required'],
            // 'is_use'=> ['required',Rule::in(0,1)],
            // 'is_show'=> ['required',Rule::in(0,1)],
            // 'is_other'=> ['required',Rule::in(0,1)],
            // 'is_subject'=> ['required',Rule::in(0,1)],
            // 'link'=> ['nullable'],
            // 'is_konkurs'=> ['required',Rule::in(0,1)],
            // 'id_site'=> ['required',Rule::in(0,1)],
            // 'is_deleted'=> ['required',Rule::in(0,1)]
        ]);
    }
}
