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

    Route::post('/user/add/store', [
        'uses' => 'UserController@store'
    ]);


    Route::get('/login', [
        'uses' => 'LogInController@login'
    ]);

    Route::get('/user/add', [
        'uses' => 'UserController@addUser'
    ]);
    Route::get('/', [
        'uses' => 'HomeController@index'
    ]);
    Route::get('/students', [
        'uses' => 'StudentController@getName'
    ]);
Route::get('/', [
    'uses' => 'HomeController@index'
]);
Route::get('/students', [
    'uses' => 'StudentController@getName'
]);
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

    Route::patch('/login/user', [
        'uses' => 'LogInController@loginUser'
    ]);

});

