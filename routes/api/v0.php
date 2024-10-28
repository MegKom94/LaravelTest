<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'anketa'], function () {
    Route::any('/', 'FormController@list');

});
