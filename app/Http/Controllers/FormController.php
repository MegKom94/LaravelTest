<?php

namespace App\Http\Controllers;

use App\Models\Form;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::get();
        dd($forms[0]);
    }
}
