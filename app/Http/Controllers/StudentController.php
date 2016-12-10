<?php

namespace App\Http\Controllers;


use App\DbModels\ParentTableConnector;
use App\DbModels\StudentTableConnector;
use Symfony\Component\HttpFoundation\Request;


class StudentController extends Controller
{


    public function getName(){
        $studentConnector = new StudentTableConnector();

        $students = $studentConnector->getName();
       
        
        return view('welcome')->with('students', $students);
        //return $students;
//       
    }

    /*  public function storeGuardian(Request $request){
   
           $conn = DBConnection::openConnection();
           //$sql="INSERT INTO `students` (`id`, `name`) VALUES (NULL,dileka)";
           $sql="INSERT INTO `guardians`(`id`, `name`, `telephone`, `created_at`, `updated_at`) VALUES (NULL ,'{$request->guardian_name}','{$request->guardian_phone}',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
           $result = $conn->query($sql);
           $conn->close();
           return $result;
       }*/


    public function newStudent()
    {
        return view('Student.new_student');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function storeStudent(Request $request)

    {
        $this->validate($request, [
            'first_name' => 'required|min:10'
        ]);

        $guardianConnector = new GuardianController();
        $result2 = $guardianConnector->storeGuardian($request);
        $studentConnector = new StudentTableConnector();

        $result = $studentConnector->storeStudent($request);


        return "{$result2}";

    }

    public function getStudents()
    {

        $studentConnector = new StudentTableConnector();

        $students = $studentConnector->getStudents();
     
        return view('Student.viewStudentDetails')->with('students', $students);
        //return view('welcome');

    }

    public function addNewClass()
    {
        $studentConnector = new StudentTableConnector();
        $namelist = $studentConnector->getName();

        return view('Student.newClass', compact('namelist'));
    }

    public function addClass(Request $request)
    {
        $studentConnector = new StudentTableConnector();

        $result = $studentConnector->addClass($request);


        return "{$result}";

    }

    public function studentManagement()
    {

        //$studentConnector=new StudentTableConnector();
        //$namelist=$studentConnector->getName();

        $studentConnector = new StudentTableConnector();

        $students = $studentConnector->getStudents();

        return view('Student.studentManagement', compact('students'));
    }

    public function viewPayment($id)
    {
        // return $id;

        $studentConnector = new StudentTableConnector();

        $students = $studentConnector->getStudents();
        $studentConnector2 = new StudentTableConnector();
        //$namelist=$studentConnector2->getName();

        // return view('Student.singleStudentManagement')->with('students', $students,'id',$id);
        return view('Student.singleStudentManagement', compact('students', 'id'));
    }

    public function updateStudent(Request $request, $id)
    {
        return $request;

        $studentConnector = new StudentTableConnector();

        $students = $studentConnector->getStudents();
        $studentConnector2 = new StudentTableConnector();
        //$namelist=$studentConnector2->getName();

        return view('Student.singleStudentManagement')->with('students', $students);
    }
}
