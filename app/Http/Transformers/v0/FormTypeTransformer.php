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
    public function transform($object, Request $request)
    {
        $response = [
            'id' => (int)$object->id,
            'title' => (string)$object->title,
        ];

        if ($this->needAppend('forms')) {
            $response['forms'] = (new FormTransformer(
                $object->forms,
                []
            ))->toArray($request);
        }

        return $response;
    }

}
