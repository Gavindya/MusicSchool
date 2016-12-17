<?php

namespace App\Http\Controllers;

use App\DAO\InstrumentDAO;
use App\DAO\TeacherDAO;
use App\teacher;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Request;

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
        $teachers =$dbCon->getNames();
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
        $teacher = new teacher();
        if (isset($request->name)) {
            $teacher->setName($request->name);
        }
        if (isset($request->telephone)) {
            $teacher->setTelephone($request->telephone);
        }
        if (isset($request->address)) {
            $teacher->setAddress($request->address);
        }
        $teacher->setJoindate(date("y-m-d"));
        $dbTeacher->addNewTeacher($teacher);
        return redirect()->route("TeacherManagement");

    }
    public function getTeachersWithoutPagination()
    {
        $dbCon = new TeacherDAO();
        $result = $dbCon->getTeachers();
        $teachers = array();
        while ($row = $result->fetch_assoc()) {
            array_push($teachers, $row);
        }
        return $teachers;
    }
    public function getTeachersWithPagination()
    {
        $dbCon = new TeacherDAO();
        $result = $dbCon->getTeachers();
        $teachers = array();
        while ($row = $result->fetch_assoc()) {
            array_push($teachers, $row);
        }

        $perPage = 4;
        $currentPage = Input::get('page') - 1;
        $pagedData = array_slice($teachers, $currentPage * $perPage, $perPage);
        $teachers = new LengthAwarePaginator($pagedData, count($teachers), $perPage);
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
    public function getTeacherInformation($id)
    {
        $dbCon = new TeacherDAO();
        $result = $dbCon->getATeacher($id);
        $teachers = array();
        array_push($teachers, $id);
        array_push($teachers, $result[1]);
        array_push($teachers, $result[2]);
        array_push($teachers, $result[3]);
        array_push($teachers, $result[4]);

        $payments = new SalaryController();
        $paymentsHistory = $payments->getPaymentsOfTeacher($id);

        $clses = new ClsController();
        $clssAssigned = $clses->getAssignedClasDetails($id);

        return view('TeacherInformation', ['teacher' => ($teachers), 'payments' => ($paymentsHistory), 'classes' => ($clssAssigned)]);
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
