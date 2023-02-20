<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', [\App\Http\Controllers\StudentController::class, 'index']);

Route::controller(\App\Http\Controllers\SubjectController::class)->group(function() {
    Route::group(['prefix' => 'subjects'], function () {
        Route::any('/', 'index');
        Route::delete('delete/{id}', 'delete')->where('id', '[0-9]+');
    });
});

    Route::controller(\App\Http\Controllers\StudentController::class)->group(function() {
        Route::group(['prefix' => 'students'], function () {
            Route::any('/', 'index');
            Route::delete('delete/{id}', 'delete')->where('id', '[0-9]+');
        });
    });

