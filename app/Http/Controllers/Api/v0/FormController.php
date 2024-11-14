<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use App\Http\Transformers\v0\FormTransformer;
use App\Http\Transformers\v0\FormUserTransformer;
use App\Models\Form;
use App\Models\FormsUsers;
use App\Models\FormType;
use DB;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use \Illuminate\Pagination\Paginator;

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
    public function statistics($form_id, Request $request)
    {
        $form = Form::where('id', $form_id)->with([
            'answers' => function ($query) {
                $query->withCount('answers_users');
            }
        ])
            ->withCount('all_answers_users')
            ->withCount([
                'all_answers_users as count_people' => function ($query) {
                    $query->select(DB::raw('count(distinct(id_user))'));
                }
            ])
            ->first();

        return new FormTransformer($form, ['answers_with_statistics' => ['statistics'], 'count_all_questions_users', 'answers_with_statistics']);
    }

    public function dateAnswers($form_id, Request $request)
    {
        $form_paginate = FormsUsers::where('id_form', $form_id)
            ->configure(request(['query', 'order', 'per_page', 'page']))->paginate();
        // dd($form_paginate);
        return new FormUserTransformer($form_paginate, ['date_answers']);
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
            'is_deleted' => ['required', Rule::in(0, 1)]
        ]);
    }
    public function delete(Form $form)
    {
        if ($form->trashed())
            return 'ErrorException';
        else
            $form->delete();

        return $this->ok();
        // forceDelete() совсем удаляет из бд

    }
    // public function restore(Form $form)
    // {
    //     if ($form->trashed())
    //         $form->restore();
    //     else
    //         return 'ErrorException';

    //     return $this->ok();
    // }
}
