<?php

namespace App\Http\Transformers\v0;

use Illuminate\Http\Request;
use App\Common\Resource\Transformer;
use App\Models\Form;

class FormTransformer extends Transformer
{
    /**
     * @param Form $object
     * @param Request $request
     * @return array
     */
    public function transform($object, Request $request)
    {
        $response = [
            'id' => (int)$object->id,
            'text' => (string)$object->text,
            // 'id_type' => (int)$object->id_type,
        ];

        return $response;
    }

}
