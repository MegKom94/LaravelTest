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
        $answer = FormAnswer::get();
        return new FormAnswerTransformer($answer, []);
    }
    public function get(FormAnswer $answer)
    {
        return new FormAnswerTransformer($answer, []);
    }
    public function create(Request $request, FormAnswer $answer)
    {
        $form = $this->validateFormAnswer($request);
        $answer->fill($form);
        $answer->form()->associate($form['id_form']);
        $answer->save();

        return $this->ok();
    }
    public function edit(Request $request, FormAnswer $answer)
    {
        $form = $this->validateFormAnswer($request);
        $answer->fill($form);
        $answer->form()->associate($form['id_form']);
        $answer->save();

        return $this->ok();
    }
    protected function validateFormAnswer($request)
    {
        return $request->validate([
            'id_form' => ['required', 'integer'],
            'text' => ['required', 'string'],
            'is_field' => ['required', Rule::in(0, 1)],
        ]);
    }
}