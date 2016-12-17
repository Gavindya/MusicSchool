<?php

namespace App\Http\Controllers;

use App\DAO\CourseDAO;
use App\DAO\InstrumentDAO;
use App\DAO\TeacherDAO;
use App\Domain\Teacher;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

class TeacherController extends Controller
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

    public function getTeachersNames()
    {
        $dbCon = new TeacherDAO();
        $teachers = $dbCon->getNames();
        return $teachers;
    }

    public function getATeacher($id)
    {
        $dbCon = new TeacherDAO();
        $result = $dbCon->getATeacher($id);
        return $result;  //can be accessed as an array $result[0] = id etc
    }

    public function addTeacher(Request $request)
    {
        $dbTeacher = new TeacherDAO();
        $teacher = new Teacher();
        if (isset($request->name)) {
            $teacher->setTeacherName($request->name);
        }
        if (isset($request->telephone)) {
            $teacher->setTeacherTelephone($request->telephone);
        }
        if (isset($request->address)) {
            $teacher->setTeacherAddress($request->address);
        }
        $teacher->setTeacherJoindate(date("y-m-d"));
        $dbTeacher->addNewTeacher($teacher);
        return redirect()->route("TeacherManagement");

    }

    public function getTeachersWithoutPagination()
    {
        $dbCon = new TeacherDAO();
        $teachers = $dbCon->getTeachers();
        return $teachers;
    }

    public function getTeachersForManagement()
    {
        $teachers = $this->getTeachersWithPagination();
        $teachers->setPath('TeacherManagement');

        $dbInstrument = new InstrumentDAO();
        $instrumentsResults = $dbInstrument->getAllInstruments();

        return view('TeacherManagement', ['teachers' => $teachers, 'instruments' => json_decode(json_encode($instrumentsResults), TRUE)]);
    }

    public function getTeachersWithPagination()
    {
        $dbCon = new TeacherDAO();
        $teachers = $dbCon->getTeachers();
        $perPage = 4;
        $currentPage = Input::get('page') - 1;
        $pagedData = array_slice($teachers, $currentPage * $perPage, $perPage);
        $teachers = new LengthAwarePaginator($pagedData, count($teachers), $perPage);
        return $teachers;
    }

    public function getTeacherInformation($teacher_id)
    {
        $dbCon = new TeacherDAO();
        $result = $dbCon->getATeacher($teacher_id);
        $teachers = array();
        array_push($teachers, $teacher_id);
        array_push($teachers, $result[1]);
        array_push($teachers, $result[2]);
        array_push($teachers, $result[3]);
        array_push($teachers, $result[4]);

        $payments = new SalaryController();
        $paymentsHistory = $payments->getPaymentsOfTeacher($teacher_id);

        $courseDAO = new CourseDAO();
        $courses = $courseDAO->getCoursesOfTeacher($teacher_id);

        return view('TeacherInformation', ['teacher' => ($teachers), 'payments' => ($paymentsHistory), 'classes' => ($courses)]);
    }

    public function updateTeacher(Request $request)
    {
        $dbCon = new TeacherDAO();
        $telephone = $request->telephone;
        $address = $request->address;
        $id = $request->id;

        $dbCon->updateTeacher($telephone, $address, $id);
        echo "inside UPDATE";
        return redirect()->route('teacherInfo', ['id' => $id]);
    }
}
