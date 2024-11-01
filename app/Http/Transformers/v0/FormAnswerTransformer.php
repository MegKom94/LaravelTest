<?php

namespace App\Http\Transformers\v0;

use Illuminate\Http\Request;
use App\Common\Resource\Transformer;
use App\Models\FormAnswer;

class FormAnswerTransformer extends Transformer
{
    /**
     * @param FormAnswer $object
     * @param Request $request
     * @return array
     */
    public function transform($object, Request $request)
    {
        $response = [
            'id' => (int)$object->id,
            'text' => (string)$object->text,
            'id_form' => (int)$object->id_form,
            'is_field' => (int)$object->is_field
        ];

        return $response;
    }

}
