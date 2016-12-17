<?php

namespace App\Http\Controllers;

use app\DAO\AttendanceDAO;
use App\DAO\EnrolmentDAO;

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

    public function showAttendanceMarking()
    {
        return view('student.studentAttendance', ['attendances' => [
            ['date' => '2016-01-01', 'state' => 'Present'],
            ['date' => '2016-01-08', 'state' => 'Absent']
        ]]);
    }

    public function markAttendance($enrollmentId)
    {
        $attendanceDAO = new AttendanceDAO();
        $enrollmentDAO = new EnrolmentDAO();
        $attendanceDAO->addAttendance($enrollmentId);

    }
}
