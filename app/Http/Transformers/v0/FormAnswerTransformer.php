<?php

namespace App\Http\Transformers\v0;

use App\Models\Form;
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
            'id' => (int) $object->id,
            'text' => (string) $object->text,
            // 'id_form' => (int)$object->id_form,
            'is_field' => (int) $object->is_field
        ];

        if ($this->needAppend('statistics')) {
            //    $response['count_answers'] = $object->answers_users()->count();
            $response['count_answers'] = (int) $object->answers_users_count;
            // dd($object->answers_users_count);
            // exit;
            $all_answers_users_count = (int) $this->getNestedAppends('all_answers_users_count')[0];
            // dd($response['count_answers']//$all_answers_users_count);
            if ($all_answers_users_count) {
                $response['percent_count_responses'] =  number_format(($response['count_answers'] / $all_answers_users_count * 100),2).'%';
            } else {
                $response['percent_count_responses'] = 0;
            }
            
            $count_users= (int) $this->getNestedAppends('count_users')[0];
            if($count_users){
                $response['percent_count_users'] = number_format(($response['count_answers'] /$count_users * 100),2).'%';
            }else{
                $response['percent_count_users'] = 0;
            }
            
        }


        return $response;
    }

}
