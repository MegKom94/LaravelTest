<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function error($message) {
        return [
            'status' => 'error',
            'message' => $message,
        ];
    }

    public function ok()
    {
        return [
            'status' => 'ok',
        ];
    }

    public function checkException(\Exception $e, array $messages)
    {
        $message = preg_replace('/\W\w+\s*(\W*)$/', '$1', $e->getMessage());

        if (!in_array($message, $messages))
            abort(500);
        else
            abort(422, $message);
    }

}
