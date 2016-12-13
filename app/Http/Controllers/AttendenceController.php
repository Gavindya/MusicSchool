<?php

namespace App\Http\Controllers;

use App\DbConnection\TeacherDAO;
use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    public function getTeachersForAttendence()
    {

        $teacherController = new TeacherController();
        $teachers = $teacherController->getTeachersWithoutPagination();
        $teacherRecord = array(null, null, null, null);
        return view('TeacherAttendence', ['teachers' => $teachers, 'teacherRecord' => $teacherRecord]);

    }

    public function markAttendence(Request $request)
    {

        $dbTeacher = new TeacherDAO();
        $id = $request->id;
        $arrive = $request->arrive;
        $depart = $request->depart;
        $dbTeacher->recordAttendence($id, $arrive, $depart);

        echo "inside UPDATE";
        return redirect()->route("TeacherAttendence");


    }

    public function getTeacherAttendenceInformation($id)
    {

        $dbCon = new TeacherDAO();
//        $result = $dbCon->getAttendence($id);
        $teacherRecord = array();
        array_push($teacherRecord, $id);
//        array_push($teacherRecord, $result[1]);
//        array_push($teacherRecord, $result[2]);
//        array_push($teacherRecord, $result[3]);
        array_push($teacherRecord, date("y-m-d"));
        array_push($teacherRecord, "4:00");
        array_push($teacherRecord, "");

        $teacherController = new TeacherController();
        $teachers = $teacherController->getTeachersWithoutPagination();

        return view('TeacherAttendence', ['teachers' => $teachers, 'teacherRecord' => $teacherRecord]);
    }
}
