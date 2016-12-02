<?php

namespace App\Http\Controllers;

class StudentController extends Controller
{
    public function getName(){
        $dbCon = new DBConnection();
        $result=$dbCon->getName();
        $students = array();
        while($row=$result->fetch_assoc()){
            array_push($students, $row['name']);
        }

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
}
