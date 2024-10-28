<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'anketa'], function () {
    Route::any('/', 'FormTypeController@list');
    Route::any('/forms', 'FormController@list');
    Route::any('/{form_type}', 'FormTypeController@get');
    Route::any('/{form_type}/list_questions', 'FormTypeController@listQuestions');

});
