<?php

namespace App\Http\Transformers\v0;

use Illuminate\Http\Request;
use App\Common\Resource\Transformer;
use App\Models\FormType;

class FormTypeTransformer extends Transformer
{
    /**
     * @param FormType $object
     * @param Request $request
     * @return array
     */
    //
    //in объект, объект запроса
    public function transform($object, Request $request)
    {
        $response = [
            'id' => (int)$object->id,
            'title' => (string)$object->title,
            'description'=> (string)$object->description,
            'is_student'=> (int)$object->is_student,
            'is_empl'=> (int)$object->is_empl,
            'is_opros'=> (int)$object->is_opros,
            'id_site'=> (int)$object->id_site,
        ];
        //если передан дополнительный параметр, в этом случае переданы ответы
        if ($this->needAppend('forms')) {
            $response['forms'] = (new FormTransformer(
                $object->forms,
                []
            ))->toArray($request);
        }

        return $response;
    }

}
