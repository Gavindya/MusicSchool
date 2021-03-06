<?php

namespace App\Http\Controllers;

use App\DAO\AttendanceDAO;
use App\DAO\CourseDAO;
use App\DAO\StudentDAO;

class StudentAttendanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getClassAttendance()
    {
        $courseDAO = new CourseDAO();
        $courses = $courseDAO->getAllCourses();
        return view('attendance.attendance-class', [
            'courses' => json_decode(json_encode($courses), TRUE)
        ]);
    }

    public function getStudentAttendance()
    {
        $studentDAO = new StudentDAO();
        $students = $studentDAO->getAllStudents();
        return view('attendance.attendance-student', [
            'students' => json_decode(json_encode($students), TRUE),
        ]);
    }

    public function showClassAttendance()
    {
        $courseDAO = new CourseDAO();
        $courses = $courseDAO->getAllCourses();
        $attendanceDAO = new AttendanceDAO();
        $filter = $_POST['filter'];
        $courseId = $_POST['course-id'];
        $date = $_POST['date'];
        if ($filter === 'All') {
            $attendances = $attendanceDAO->getClassAttendance($courseId, $date);
            return view('attendance.attendance-class', [
                'courses' => json_decode(json_encode($courses), TRUE),
                'attendances' => json_decode(json_encode($attendances), TRUE)
            ]);
        }elseif ($filter === 'Absent'){
            $attendances = $attendanceDAO->getClassAttendanceAbsent($courseId, $date);
            return view('attendance.attendance-class', [
                'courses' => json_decode(json_encode($courses), TRUE),
                'attendances' => json_decode(json_encode($attendances), TRUE)
            ]);
        }else{
            $attendances = $attendanceDAO->getClassAttendancePresent($courseId, $date);
            return view('attendance.attendance-class', [
                'courses' => json_decode(json_encode($courses), TRUE),
                'attendances' => json_decode(json_encode($attendances), TRUE)
            ]);
        }
        $attendances = $attendanceDAO->getClassAttendance($courseId);
        return view('attendance.attendance-class', [
            'courses' => json_decode(json_encode($courses), TRUE),
            'attendances' => json_decode(json_encode($attendances), TRUE),
            'courseName' => $courseId
        ]);
    }

    public function showStudentAttendance()
    {
        $studentDAO = new StudentDAO();
        $students = $studentDAO->getAllStudents();
        $attendanceDAO = new AttendanceDAO();
        $studentId = $_POST['student-id'];
        $attendances = $attendanceDAO->getStudentAttendance($studentId);
        return view('attendance.attendance-student', [
            'students' => json_decode(json_encode($students), TRUE),
            'attendances' => json_decode(json_encode($attendances), TRUE)
        ]);
    }

    public function markAttendance($enrollmentId)
    {
        $attendanceDAO = new AttendanceDAO();
        $attendanceDAO->addAttendance($enrollmentId);
    }
}
