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

Route::get('/', [
    'uses'=> 'StudentController@getName'
]);
Route::get('/Teacher', [
    'uses' => 'TeacherController@getTeachersNames',
    
]);
Route::patch('/addTeacher', [
    'uses' => 'TeacherController@addTeacher',
]);

Route::patch('/updateTeacher', [
    'uses' => 'TeacherController@updateTeacher',
    'as' => 'updateTeacher'
]);

Route::get('/TeacherManagement', [
    'uses' => 'TeacherController@getTeachersForManagement',
    'as' => 'TeacherManagement'
]);

Route::get('/TeacherInformation/ID/{id}', [
    'uses' => 'TeacherController@getTeacherInformation',
    'as' => 'teacherInfo'
]);

/*Attendence rotes*/
Route::get('/TeacherAttendence', [
    'uses' => 'AttendenceController@getTeachersForAttendence',
    'as' => 'TeacherAttendence'
]);

Route::get('/TeacherAttendence/{id}', [
    'uses' => 'AttendenceController@getTeacherAttendenceInformation',
    'as' => 'attendence'
]);

Route::patch('/markAttenedence', [
    'uses' => 'AttendenceController@markAttendence',
]);

Route::get('/Payrole', [
    'uses' => 'SalaryController@getPayments',
    'as' => 'salaryController'
]);
Route::patch('/payTeachers', [
    'uses' => 'SalaryController@payTeachers',
]);