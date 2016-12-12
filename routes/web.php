<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::group(['middleware' => ['web']], function () {
    Route::get('/', [
        'uses' => 'HomeController@index'
    ]);
    Route::get('/students', [
        'uses' => 'StudentController@getName'
    ]);

    Route::get('/student/new', [
        'uses' => 'StudentController@newStudent'
    ]);

    Route::post('/student/enroll', [
        'uses' => 'StudentController@storeStudent'
    ]);

    Route::get('/view/students', [
        'uses' => 'StudentController@getStudents'
    ]);
    Route::get('/student/new_class', [
        'uses' => 'StudentController@addNewClass'
    ]);
    Route::post('/student/subscribe', [
        'uses' => 'StudentController@addClass'
    ]);
    Route::get('/student/management', [
        'uses' => 'StudentController@studentManagement'
    ]);
    Route::get('/student/view/payment/{id}', [
        'uses' => 'StudentController@viewPayment'
    ]);
    Route::post('/student/{id}/update', [
        'uses' => 'StudentController@updateStudent'
    ]);
    Route::get('/student/progress/{id}', [
        'uses' => 'StudentController@viewProgress'
    ]);

});

