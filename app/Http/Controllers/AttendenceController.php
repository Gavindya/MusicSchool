<?php

namespace App\Http\Controllers;

use App\DAO\TeacherDAO;
use Illuminate\Http\Request;

class AttendenceController extends Controller
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

    public function getTeachersForAttendence()
    {

        $teacherController = new TeacherController();
        $teachers = $teacherController->getTeachersWithoutPagination();
        $teacherRecord = array(null, null, null, null);
        $teacher = array(null, null);
        return view('TeacherAttendence', ['teacher' => $teacher, 'teachers' => $teachers, 'teacherRecord' => $teacherRecord]);

    }

    public function markAttendence(Request $request)
    {
        $id = $request->id;
        $dbTeacher = new TeacherDAO();
        $teacherRecord = $this->getAttendenceOfTeacher($id);
        if ($teacherRecord == null) {
            echo("in arrival set");
            $arrive = $request->arrive;
            //THIS WORKS BAAAAD!
            if ($arrive != "00:00:00") {
                $dbTeacher->setArriveTime($id, $arrive);
            }
        } else {
            echo("depart set");
            $depart = $request->depart;
            $dbTeacher->updateLeaveTime($id, $depart);
        }

        return redirect()->route("TeacherAttendence");
    }

    public function getTeacherAttendenceInformation($id)
    {
        $teacherRecord = $this->getAttendenceOfTeacher($id);

        $teacherController = new TeacherController();
        $teachers = $teacherController->getTeachersWithoutPagination();

        $teacher = $teacherController->getATeacher($id); //$teacher[0]=id $teacher[1]=name

        return view('TeacherAttendence', ['teacher' => $teacher, 'teachers' => $teachers, 'teacherRecord' => $teacherRecord]);
    }

    public function getAttendenceOfTeacher($id)
    {
        $dbCon = new TeacherDAO();
        $teacherRecord = $dbCon->getAttendence($id); // $teacherRecord[0]=id $teacherRecord[1]=date $teacherRecord[2]=arrive_time $teacherRecord[3]=depart_time
        return $teacherRecord;
    }
}
