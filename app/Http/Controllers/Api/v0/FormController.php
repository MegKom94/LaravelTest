<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use App\Models\Form;

class FormController extends Controller
{
    public function list()
    {
        dd(123);
    }
    public function index()
    {
        $forms = Form::get();
        dd($forms[0]);
    }
}
