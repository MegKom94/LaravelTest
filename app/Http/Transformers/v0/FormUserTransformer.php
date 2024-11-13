<?php

namespace App\Http\Transformers\v0;

use Illuminate\Http\Request;
use App\Common\Resource\Transformer;
use App\Models\FormsUsers;

class FormUserTransformer extends Transformer
{
    /**
     * @param FormsUsers $object
     * @param Request $request
     * @return array
     */
    public function transform($object, Request $request)
    {
        // dd(debug_backtrace());
        $response = [
            // 'id' => (int) $object->id,
            'id_user' => (int) $object->id_user,
            'answer' => (string) $object->answer,
            'other' => (string) $object->other,
            'id_exec' => (int) $object->id_exec,
            'id_dep' => (int) $object->id_dep,
            'id_position' => (int) $object->id_position,
            'old' => (int) $object->old,
            'id_subject' => (int) $object->id_subject,
            'id_teacher' => (int) $object->id_teacher,
            'course' => (int) $object->course,
            'is_anon' => (int) $object->is_anon,
            'date' => $object->date
        ];
        if ($this->needAppend('date_answers')) {
            $response = ['date' => $object->date];
        }
        return $response;
    }

}
