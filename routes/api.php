<?php

use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'authorize'], function () {
    Route::controller(UserController::class)->group(function (){
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::get('resources', 'resources');
        Route::any('logout', 'logout');
    });
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::controller(UserController::class)->group(function (){
        Route::post('check_valid_access_token', function (){
            return [
              'status_code' => 200,
              'is_valid_token' => true
            ];
        });
    });

    Route::controller(\App\Http\Controllers\SubjectController::class)->group(function () {
        Route::group(['prefix' => 'subjects'], function () {
            Route::any('/', 'index');
            Route::delete('delete/{id}', 'delete')->where('id', '[0-9]+');
            Route::any('resources/{id?}', 'resources');
            Route::put('edit', 'add');
            Route::post('add', 'add');
        });
    });

    Route::controller(\App\Http\Controllers\StudentController::class)->group(function () {
        Route::group(['prefix' => 'students'], function () {
            Route::any('/', 'index');
            Route::delete('delete/{id}', 'delete')->where('id', '[0-9]+');
            Route::any('resources/{id?}', 'resources');
            Route::put('edit', 'add');
            Route::post('add', 'add');
        });
    });
});

