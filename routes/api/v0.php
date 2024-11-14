<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'anketa'], function () {
    Route::any('/', 'FormTypeController@list');
    Route::any('/create', 'FormTypeController@create');

    Route::group(['prefix' => 'quest'], function () {
        Route::any('/', 'FormController@list');
        // Route::any('/', 'FormController@list');
        Route::any('/create', 'FormController@create');
        Route::any('/{form}', 'FormController@get');
        Route::any('/{form}/edit', 'FormController@edit');
        Route::any('/{form}/delete', 'FormController@delete')->withTrashed();
        // Route::any('/{form}/restore', 'FormController@restore')->withTrashed();
        Route::any('/{form_id}/statistics', 'FormController@statistics');
        Route::any('/{form_id}/date_answers', 'FormController@dateAnswers');
        Route::any('/{form}/list_answers', 'FormController@listAnswers');
    });

    Route::group(['prefix' => 'answer'], function () {
        Route::any('/', 'FormAnswerController@list');
        Route::any('/create', 'FormAnswerController@create');
        Route::any('/{answer}', 'FormAnswerController@get');
        Route::any('/{answer}/edit', 'FormAnswerController@edit');
    });

    Route::any('/{form_type}', 'FormTypeController@get');
    Route::any('/{form_type}/edit', 'FormTypeController@edit');
    Route::any('/{form_type_id}/statistics', 'FormTypeController@statistics');
    Route::any('/{form_type}/list_questions', 'FormTypeController@listQuestions');
    Route::any('/{form_type}/delete', 'FormTypeController@delete')->withTrashed();




});
