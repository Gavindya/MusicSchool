<?php

namespace App\Http\Controllers;

use App\DbConnection\InstrumentDAO;
use App\DbConnection\TeacherDAO;
use App\teacher;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Request;

class TeacherController extends Controller
{
    public function getTeachersNames()

    {
        $dbCon = new TeacherDAO();
        $result = $dbCon->getName();
        $teachers = array();
        while ($row = $result->fetch_assoc()) {
            array_push($teachers, $row['name']);
        }
        return view('addTeacher')->with('teachers', $teachers);
    }

    public function getATeacher($id)
    {
        $dbCon = new TeacherDAO();
        $result = $dbCon->getATeacher($id);
        $teacher = array();
        array_push($teachers, $id);
        array_push($teachers, $result[1]);
        array_push($teachers, $result[2]);
        array_push($teachers, $result[3]);
        array_push($teachers, $result[4]);
        array_push($teachers, $result[5]);

        return $teacher;
    }


    public function addTeacher(Request $request)
    {
        $dbTeacher = new TeacherDAO();
//       $result=$dbCon->addNewTeacher();
        $teacher = new teacher();
        if (isset($request->name)) {
            $teacher->setName($request->name);
        }
        $dbTeacher->addNewTeacher($teacher);
        $request->session()->flash('alert-success', 'User was successful added!');
        return redirect()->route("TeacherManagement");
//        echo $teacher->getName();
//        echo "sent to Teacher DAO";
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
        $instrumentsResults = $dbInstrument->getInstruments();
        $instruments = array();
        while ($row = $instrumentsResults->fetch_assoc()) {
            array_push($instruments, $row);
        }

        return view('TeacherManagement', ['teachers' => $teachers, 'instruments' => $instruments]);
    }

    public function getTeacherInformation($id)
    {
        $dbCon = new TeacherDAO();
        $result = $dbCon->getATeacher($id);
        $teachers = array();
//        echo $result[0];  /*id*/
//        echo $result[1];  /*name*/
        array_push($teachers, $id);
        array_push($teachers, $result[1]);
        array_push($teachers, $result[4]);
        array_push($teachers, $result[5]);

        $payments = new SalaryController();
        $paymentsHistory = $payments->getPaymentsOfTeacher($id);
        array_push($teachers, $paymentsHistory);

        $clses = new ClsController();
        $clssAssigned = $clses->getAssignedClasDetails($id);
        array_push($teachers, $clssAssigned);

//        return view('TeacherInformation', ['teacherId' => ($id),'teacherName' => ($result[1])]);
        return view('TeacherInformation', ['teacher' => ($teachers)]);

    }


    public function updateTeacher(Request $request)
    {
        $dbCon = new TeacherDAO();
        $mobile = $request->mobile;
        $address = $request->address;
        $id = $request->id;
        $dbCon->updateTeacher($mobile, $address, $id);
        echo "inside UPDATE";
        return redirect()->route('teacherInfo', ['id' => $id]);

    }


}
