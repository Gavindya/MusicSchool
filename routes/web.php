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

Route::get('/', 'CourseController@showCourseManagement');
Route::get('/courses/manage', 'CourseController@showCourseManagement');
Route::get('/courses/{id}/details', 'CourseController@showCourseDetails');
Route::get('/student/attendance', 'AttendanceController@showAttendanceMarking');