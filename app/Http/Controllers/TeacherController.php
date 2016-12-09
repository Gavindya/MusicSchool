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

    public function getTeachers()
    {
        $dbCon = new TeacherDAO();
        $dbInstrument = new InstrumentDAO();
        $instrumentsResults = $dbInstrument->getInstruments();
        $instruments = array();
        while ($row = $instrumentsResults->fetch_assoc()) {
            array_push($instruments, $row);
        }
        $result = $dbCon->getTeachers();
        $teachers = array();
        while ($row = $result->fetch_assoc()) {
            array_push($teachers, $row);
        }
        $perPage = 4;
        $currentPage = Input::get('page') - 1;
        $pagedData = array_slice($teachers, $currentPage * $perPage, $perPage);
        $teachers = new LengthAwarePaginator($pagedData, count($teachers), $perPage);
        $teachers->setPath('TeacherManagement');
//        foreach ($teachers as &$value) {
//            echo $value['name'];
//        }
//        return view('TeacherManagement')->with('teachers', $teachers);
        return view('TeacherManagement', ['teachers' => $teachers, 'instruments' => $instruments]);
    }

    public function getTeacherInformation($id)
    {
        
        return view('TeacherInformation', ['teacherID' => ($id)]);
    }
}
