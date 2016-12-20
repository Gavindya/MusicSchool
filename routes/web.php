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

Route::get('/teachers/all', 'CourseController@getAllTeachers');
Route::get('/instruments/all', 'CourseController@getAllInstruments');

// Routes for loading teaches table
Route::get('/teaches/instrument/{id}', 'SchoolAdministrationController@getTeachesByInstrumentId');
Route::get('/teaches/teacher/{id}', 'SchoolAdministrationController@getInstrumentsByTeacherId');

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
//Route::get('/login', [
//    'uses' => 'LogInController@showLoginView'
//]);

Route::post('/user/add/store', [
    'uses' => 'UserController@addUser'
]);
//Route::patch('/login/user', [
//    'uses' => 'LogInController@loginUser'
//]);

/*
|--------------------------------------------------------------------------
| Login-Logout-woth user
|--------------------------------------------------------------------------
*/
//Route::post('/loginUser', [
//    'uses' => 'AuthController@login',
//    'as'=>'loginUser'
//]);
//Route::get('/logoutUser', [
//    'uses' => 'AuthController@logout'
//]);
//Route::get('/homePHP', [
//    'uses' => 'LogInController@routeHandle',
//    'as'=>'home'
//]);
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
Route::get('/user/add', function () {
    return view('Users.add_user');
});


Route::patch('/class/search/students', [
    'uses' => 'StudentController@searchStudentsForClass'
]);
Route::patch('/student/management/search', [
    'uses' => 'StudentController@searchStudentsForManagement'
]);


/*
|--------------------------------------------------------------------------
| Teacher Management
|--------------------------------------------------------------------------
*/
//Route::get('/Teacher', [
//    'uses' => 'TeacherController@getTeachersNames',
//]);
Route::patch('/addTeacher', [
    'uses' => 'TeacherController@addTeacher',
]);

Route::patch('/updateTeacher', [
    'uses' => 'TeacherController@updateTeacher',
    'as' => 'updateTeacher'
]);

Route::patch('/updateTeacherHimself', [
    'uses' => 'TeacherController@updateTeacherHimself',
    'as' => 'updateTeacherHimself'
]);

Route::get('/TeacherManagement', [
    'uses' => 'TeacherController@getTeachersForManagement',
    'as' => 'TeacherManagement'
]);

Route::get('/TeacherInformation/ID/{id}', [
    'uses' => 'TeacherController@getTeacherInformation',
    'as' => 'teacherInfo'
]);

Route::get('/Teacher', [
    'uses' => 'TeacherController@getPersonalPage',
    'as' => 'teacher'
]);

Route::get('/Resign/{id}', [
    'uses' => 'TeacherController@resignTeacher',
    'as' => 'resign'
]);

/*
|--------------------------------------------------------------------------
| Teacher Attendance
|--------------------------------------------------------------------------
*/
Route::get('/TeacherAttendence', [
    'uses' => 'TeacherAttendanceController@getTeachersForAttendence',
    'as' => 'TeacherAttendence'
]);

Route::get('/TeacherAttendence/{id}', [
    'uses' => 'TeacherAttendanceController@getTeacherAttendenceInformation',
    'as' => 'attendence'
]);

Route::patch('/markAttenedence', [
    'uses' => 'TeacherAttendanceController@markAttendence',
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
    'as' => 'payrollSummary'
]);
Route::get('/PayrollSummary/ThisMonth', [
    'uses' => 'SalaryController@getSummaryThisMonth',
]);

Route::patch('/setPaymentPerHour', [
    'uses' => 'SalaryController@setPaymentPerHour',
]);

Route::patch('/setPaymentDate', [
    'uses' => 'SalaryController@setPaymentDate',
]);
/*
|--------------------------------------------------------------------------
| Student Attendance
|--------------------------------------------------------------------------
*/
Route::get('/Attendance/Class', [
    'uses' => 'StudentAttendanceController@getClassAttendance'
]);

Route::post('/Attendance/Class', [
    'uses' => 'StudentAttendanceController@showClassAttendance'
]);

Route::get('/Attendance/Student', [
    'uses' => 'StudentAttendanceController@getStudentAttendance'
]);

Route::post('/Attendance/Student', [
    'uses' => 'StudentAttendanceController@showStudentAttendance'
]);

Route::get('/Attendance/Mark',[
    'uses' => 'StudentAttendanceController@getMarkAttendance'
]);

Route::post('/Attendance/Mark',[
    'uses' => 'StudentAttendanceController@getEnrolledStudents'
]);

Route::post('Attendance/Mark/MarkAttendance',[
    'uses' => 'StudentAttendanceController@markAttendance'
]);