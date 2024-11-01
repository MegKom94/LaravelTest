<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use App\Http\Transformers\v0\FormAnswerTransformer;
use App\Models\Form;
use App\Models\FormAnswer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FormAnswerController extends Controller
{
    public function list()
    {
        $form = FormAnswer::get();
        return new FormAnswerTransformer($form, []);
    }
    public function get(FormAnswer $formAnswer)
    {
        return new FormAnswerTransformer($formAnswer, []);
    }
    public function create(Request $request, FormAnswer $formAnswer)
    {
        $form = $request->validate([
            'id_form' => ['required', 'integer'],
            'text' => ['required', 'string'],
            'is_field' => ['required', Rule::in(0, 1)],
        ]);
        $formAnswer->fill($form);
        $formAnswer->form()->associate($form['id_form']);
        $formAnswer->save();
        
        return $this->ok();
    }
    public function edit(Request $request, FormAnswer $formAnswer)
    {
        $form = $request->validate([
            'id_form' => ['required', 'integer'],
            'text' => ['required', 'string'],
            'is_field' => ['required', Rule::in(0, 1)],
        ]);
        $formAnswer->fill($form);
        $formAnswer->form()->associate($form['id_form']);
        $formAnswer->save();
        
        return $this->ok();
    }
    //Связь один ко многим с моделью Form по id=1
    public function connection()
    {
        $result = Form::find(1)->form_answer;
        dd($result);
    }
}