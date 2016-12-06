<?php

namespace App\Http\Controllers;


use App\DbConnection\DBConnection;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends Controller
{
    public function getName(){
        $dbCon = new DBConnection();
        $result=$dbCon->getName();
        $students = array();
        while($row=$result->fetch_assoc()){
            array_push($students, $row['name']);
        }
        return view('welcome')->with('students', $students);
//       
    }


    public function newStudent()
    {
        return view('Student.new_student');
    }

    public function storeStudent(Request $request)
    {

        $dbCon = new DBConnection();
        $result = $dbCon->storeStudent($request);

        return $result->fetch_assoc();

    }

    public function getStudents()
    {

        $dbCon = new DBConnection();
        $result = $dbCon->getStudents();
        $students = array();

        while ($row = $result->fetch_assoc()) {

            array_push($students, $row);
        }

        return view('Student.viewStudentDetails')->with('students', $students);
        //return view('welcome');

    }
}
