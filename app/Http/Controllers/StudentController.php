<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function getName(){
        $dbCon = new DBConnection();
        $dbCon->getName();
//        $student_list=DB::select("select * from students");
//        return view('welcome')->with('students', $student_list);
    }
}
