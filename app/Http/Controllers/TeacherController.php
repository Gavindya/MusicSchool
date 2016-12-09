<?php

namespace App\Http\Controllers;


use App\DbConnection\TeacherDAO;
use App\teacher;
use Symfony\Component\HttpFoundation\Request;

class TeacherController extends Controller
{
    public function getTeachers()
    {
        $dbCon = new TeacherDAO();
        $result = $dbCon->getName();
        $teachers = array();
        while ($row = $result->fetch_assoc()) {
            array_push($teachers, $row['name']);
        }
        return view('addTeacher')->with('teachers', $teachers);

//        if ($result->num_rows > 0) {
//            // output data of each row
//            return view('welcome')->with('students', $students);
////            while($row = $result->fetch_assoc()) {
////                echo "name: " . $row["name"]. "<br>";
////            }
//        } else {
//            echo "0 results";
//        }
    }

    public function addTeacher(Request $request)
    {


        $dbCon = new TeacherDAO();
//       $result=$dbCon->addNewTeacher();
        $teacher = new teacher();
        if (isset($request->name)) {
            $teacher->setName($request->name);
        }
        $dbCon->addNewTeacher($teacher);
        echo $teacher->getName();
        echo "sent to Teacher DAO";
    }
}
