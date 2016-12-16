<?php

namespace App\Http\Controllers;

use app\DAO\AttendanceDAO;
use App\DAO\EnrolmentDAO;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function showAttendanceMarking()
    {
        return view('student.studentAttendance',['attendances'=>[
            ['date'=>'2016-01-01','state'=>'Present'],
            ['date'=>'2016-01-08','state'=>'Absent']
        ]]);
    }

    public function markAttendance($enrollmentId)
    {
        $attendanceDAO = new AttendanceDAO();
        $enrollmentDAO = new EnrolmentDAO();
        $attendanceDAO->insertAttendance($enrollmentId);

    }
}
