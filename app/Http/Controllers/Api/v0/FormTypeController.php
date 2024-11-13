<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Transformers\v0\FormTypeTransformer;
use App\Http\Controllers\Controller;
use App\Models\FormsUsers;
use App\Models\FormType;
use DB;
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
        return new FormTypeTransformer($form_type, ['forms' => 'answers']);
    }
    public function statistics($form_type_id)
    {
        $form_type = FormType::where('id', $form_type_id)
            //жадная загрузка- достаем ("вопросы","связку связки") ->объЯВЛЯЕМ УСЛОВИЕ ПО КОТРОЙ БУЕТ ПРОХОДИТЬ ЖАДНАЯ СВЯЗКА 
            ->with([
                'forms' => function ($query) {
                    $query->withCount('all_answers_users');
                    $query->withCount(['all_answers_users as count_people' => function ($query) {
                        $query->select(DB::raw('count(distinct(id_user))'));
                    }]);
                },
                'forms.answers' => function ($query) {
                    //подзапрос где происходит подсчет внутренней связки
                    $query->withCount('answers_users');
                }
            ])
            ->first();
        // dd($form_type->toArray());
        return new FormTypeTransformer($form_type, ['forms' => ['answers_with_statistics' => ['statistics'], 'count_all_questions_users']]);
    }
    // //Связь один ко многим с моделью FormType по id=1
    // public function connection(){
    //     $result = FormType::find(1)->form;
    //     dd($result);

    // }
    public function create(Request $request, FormType $form_type)
    {
        $form = $this->validateFormType($request);
        $form_type->fill($form);
        $form_type->save();

        return $this->ok();
    }
    public function edit(Request $request, FormType $form_type)
    {
        $form = $this->validateFormType($request);
        $form_type->fill($form);
        $form_type->save();

        return $this->ok();
    }
    protected function validateFormType($request)
    {
        return $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            // 'is_stydent'=> ['required', Rule::in(0,1), 'integer'],
            // 'is_empl'=> ['required',Rule::in(0,1), 'integer'],
            // 'is_opros'=> ['required',Rule::in(0,1), 'integer'],
            // 'id_site'=> ['required',Rule::in(0,1), 'integer']
        ]);
    }
}
