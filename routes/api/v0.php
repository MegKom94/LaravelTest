<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'anketa'], function () {
    Route::any('/', 'FormTypeController@list');
    Route::any('/create', 'FormTypeController@create');
    
    Route::any('/{form_type}', 'FormTypeController@get');
    Route::any('/{form_type}/edit', 'FormTypeController@edit');
    Route::any('/{form_type}/list_questions', 'FormTypeController@listQuestions');

    Route::group(['prefix' => 'quest'], function () {
        Route::any('/', 'FormController@list');
        Route::any('/create', 'FormController@create');
        Route::any('/{form}', 'FormController@get');
        Route::any('/{form}/edit', 'FormController@edit');
    });

    Route::group(['prefix' => 'answer'], function () {
        Route::any('/', 'FormAnswerController@list');
        Route::any('/create', 'FormAnswerController@create');
        Route::any('/{answer}', 'FormAnswerController@get');
        Route::any('/{answer}/edit', 'FormAnswerController@edit');
        
    });
});
