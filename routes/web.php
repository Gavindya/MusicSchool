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

//Route::get('/Generate', [
//    'uses' => 'SalaryController@generateSalary',
//    'as' => 'generate'
//]);

/*Teacher management rotes*/
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
/*Teacher paymemts rotes*/
Route::get('/Payrole', [
    'uses' => 'SalaryController@getAllPayments',
    'as' => 'salaryController'
]);

Route::get('/Payrole/ThisMonth', [
    'uses' => 'SalaryController@getPaymentsOfThisMonth',
]);

Route::patch('/payTeachers', [
    'uses' => 'SalaryController@payTeachers',
]);

Route::get('/PayrollSummary', [
    'uses' => 'SalaryController@getSummary',
]);
Route::get('/PayrollSummary/ThisMonth', [
    'uses' => 'SalaryController@getSummaryThisMonth',
]);

/*course routes - Y*/
Route::get('/', 'HomeController@index');

Route::get('/courses', 'CourseController@showCourseManagement');
Route::post('/courses', 'CourseController@addCourse');

Route::get('/courses/{id}', 'CourseController@showCourseDetails');
Route::post('/courses/{id}', 'CourseController@editCourse');


/*Routes added by laravel, not me :) - Y*/
Auth::routes();

Route::get('/home', 'HomeController@index');
