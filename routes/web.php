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

/*
|--------------------------------------------------------------------------
| Course Management
|--------------------------------------------------------------------------
*/

Route::get('/courses', 'CourseController@showCourseManagement');
Route::post('/courses', 'CourseController@addCourse');

Route::get('/courses/{id}', 'CourseController@showCourseDetails');
Route::post('/courses/{id}', 'CourseController@editCourse');

/*
|--------------------------------------------------------------------------
| Course Management
|--------------------------------------------------------------------------
*/

Route::get('/administration', 'SchoolAdministrationController@showSchoolAdministration');
Route::post('/administration/timeslots/add', 'SchoolAdministrationController@addTimeslot');
Route::post('/administration/instruments/add', 'SchoolAdministrationController@addInstrument');
Route::post('/administration/timeslots/edit', 'SchoolAdministrationController@updateTimeslot');
Route::post('/administration/instruments/edit', 'SchoolAdministrationController@updateInstrument');
/*
|--------------------------------------------------------------------------
| User / Login (Not needed really, because laravel provides this)
| [Can implement default authentication middleware and override it with raw
| sql queries. See the project. Authentication is already implemented]
|--------------------------------------------------------------------------
*/
Route::get('/user/add', [
    'uses' => 'UserController@showAddUserView'
]);
Route::get('/login', [
    'uses' => 'LogInController@showLoginView'
]);

Route::post('/user/add/store', [
    'uses' => 'UserController@addUser'
]);
Route::patch('/login/user', [
    'uses' => 'LogInController@loginUser'
]);
/*
|--------------------------------------------------------------------------
| Home - With included authentication redirects
|--------------------------------------------------------------------------
*/
Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

/*
|--------------------------------------------------------------------------
| Student Management
|--------------------------------------------------------------------------
*/

// GET
Route::get('/students', [
    'uses' => 'StudentController@showStudentsView'
]);
Route::get('/student/new', [
    'uses' => 'StudentController@showNewStudentView'
]);
Route::get('/view/students', [
    'uses' => 'StudentController@showStudentDetailsView'
]);
Route::get('/student/new_class', [
    'uses' => 'StudentController@showNewEnrolmentView'
]);
Route::get('/student/management', [
    'uses' => 'StudentController@showStudentManagementView'
]);
Route::get('/student/view/payment/{id}', [
    'uses' => 'StudentController@showStudentFeesView'
]);
Route::post('/student/{id}/update', [
    'uses' => 'StudentController@showStudentUpdateView'
]);
Route::get('/student/progress/{id}', [
    'uses' => 'StudentController@showStudentProgressView'
]);

// POST
Route::post('/student/enroll', [
    'uses' => 'StudentController@enrolStudent'
]);
Route::post('/student/subscribe', [
    'uses' => 'StudentController@addNewEnrolment'
]);
/*
|--------------------------------------------------------------------------
| Teacher Management
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| Teacher Attendance
|--------------------------------------------------------------------------
*/
Route::get('/TeacherAttendence', [
    'uses' => 'TeacherAttendanceController@showTeacherAttendanceView',
    'as' => 'TeacherAttendence'
]);
Route::get('/TeacherAttendence/{id}', [
    'uses' => 'TeacherAttendanceController@showTeacherAttendanceInformationView',
    'as' => 'attendence'
]);
Route::patch('/markAttenedence', [
    'uses' => 'TeacherAttendanceController@addTeacherAttendance',
]);

/*
|--------------------------------------------------------------------------
| Teacher Payments
|--------------------------------------------------------------------------
*/
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