<?php

use App\Http\Controllers\Api\V1\NewsController;
use App\Http\Controllers\Api\V1\NptelCourseController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // News API
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{slug}', [NewsController::class, 'show']);

    // NPTEL API
    Route::get('/nptel-courses', [NptelCourseController::class, 'index']);
    Route::get('/nptel-courses/{slug}', [NptelCourseController::class, 'show']);

});