<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v0')
    // ->middleware(['auth:api', 'throttle:api'])
    ->namespace('v0')
    ->group(base_path('routes/api/v0.php'));
