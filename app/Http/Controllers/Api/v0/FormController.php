<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use App\Http\Transformers\v0\FormTransformer;
use App\Models\Form;
use App\Models\FormsUsers;
use App\Models\FormType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FormController extends Controller
{
    public function list()
    {
        $question = Form::get();
        return new FormTransformer($question, []);
    }
    //получение результата запроса на получение списка вопросов по заголовку
    public function get(Form $form)
    {
        return new FormTransformer($form, []);
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
    public function statistics($form_id)
    {
        $form = Form::where('id', $form_id)->with([
            'answers' => function ($query) {
                $query->withCount('answers_users');
            }
        ])
            ->withCount('all_answers_users')
            ->first();
        return new FormTransformer($form, ['answers_with_statistics' => ['statistics'], 'count_all_questions_users','answers_with_statistics']);
    }
    public function listAnswers(Form $form)
    {
        return new FormTransformer($form, ['answers']);
    }


    protected function validateForm($request)
    {
        return $request->validate([
            'text' => ['required', 'string'],
            'id_type' => ['required', 'integer'],
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
