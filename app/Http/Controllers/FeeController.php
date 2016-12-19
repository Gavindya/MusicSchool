<?php

namespace App\Http\Controllers;

use App\DbConnection\DBConnection;
use App\DbModels\ClassTableConnector;
use App\DbModels\EnrollTableConnector;
use App\DbModels\StudentPaymentsConnector;
use App\DbModels\StudentTableConnector;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    //
    
    public  function showFeeWindow(){
        $search=0;
        $conn = DBConnection::openConnection();
        $studentConnector=new StudentTableConnector();
        $students=$studentConnector->getStudents($conn);
        return view('Student.addFees',compact('search','students'));
    }
    public  function addFee($id){
        $conn = DBConnection::openConnection();

        $studentConnector = new StudentTableConnector();

        list($conn, $students) = $studentConnector->getStudents($conn);
        $enrollConnector = new EnrollTableConnector();
        list($conn, $enrolments) = $enrollConnector->getEnrolmentsById($conn, $id);
       
        $classConnector=new ClassTableConnector();
        list($conn, $classDetails) = $classConnector->getClassDetails($conn);
        $conn->close();
        $search=0;
  //return[$enrolments,$classDetails];
        // return view('Student.singleStudentManagement')->with('students', $students,'id',$id);
        return view('Student.addFeeForStudent', compact('students', 'id', 'enrolments','search','classDetails'));
    }
    public  function searchStudentsForFee(Request $request){

        // return '%'.$request->guess.'%';
        $conn = DBConnection::openConnection();
        $studentConnector = new StudentTableConnector();

        list($conn, $students) = $studentConnector->searchStudents($conn, $request);
        $search=1;
        return view('Student.addFees', compact('students','search'));


    }
    public function addFeeToDatabase($id,Request $request){


       $student_id=$id;
        $conn = DBConnection::openConnection();

   
        $enrollConnector = new EnrollTableConnector();
        list($conn, $enrolment_id) = $enrollConnector->getEnrolmentId($conn, $id,$request->class_id);
        $studentPaymentConnector=new StudentPaymentsConnector();


 
       $conn=$studentPaymentConnector->addFee($conn,$enrolment_id[0]['id'], $request);
        $conn->close();
        $search=0;
    
        session()->flash('msg', 'Fee is  added successfully.');
        return view('Student.addFees', compact('students','search'));
    }
}
