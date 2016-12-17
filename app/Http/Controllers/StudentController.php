<?php

namespace App\Http\Controllers;


use App\DbConnection\DBConnection;
use App\DbModels\ClassTableConnector;
use App\DbModels\EnrollTableConnector;
use App\DbModels\ParentTableConnector;
use App\DbModels\StudentPaymentsConnector;
use App\DbModels\studentProgressConnector;
use App\DbModels\StudentTableConnector;
use Symfony\Component\HttpFoundation\Request;


class StudentController extends Controller
{


    public function getName()
    {

        $conn = DBConnection::openConnection();
        $studentConnector = new StudentTableConnector();

        list($conn, $students) = $studentConnector->getName($conn);
        $conn->close;
        
        return view('welcome')->with('students', $students);
        //return $students;
//       
    }




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
            'first_name', 'last_name' => 'required|min:2|max:45',
            'guardian_phone' => 'required|digits:10',
            'student_phone_number' => 'required|digits:10',
            'student_address' => 'required|max:45',
            'guardian_name' => 'required|min:2|max:45'
        ]);

        $conn = DBConnection::openConnection();

        $guardianConnector = new GuardianController();
        $result = $guardianConnector->storeGuardian($conn, $request);

        $studentConnector = new StudentTableConnector();

        $result2 = $studentConnector->storeStudent($result, $request);

        session()->flash('msg', 'Admission is successful.');
        return redirect()->back();
        //return Redirect::back()->with('msg', 'The Message');
    }


    public function getStudents()
    {
        $conn = DBConnection::openConnection();
        $studentConnector = new StudentTableConnector();

        list($conn, $students) = $studentConnector->getStudents($conn);
        $conn->close();
     
        return view('Student.viewStudentDetails')->with('students', $students);
        //return view('welcome');

    }

    public function addNewClass()
    {
        $conn = DBConnection::openConnection();
        $studentConnector = new StudentTableConnector();
        list($conn, $students) = $studentConnector->getStudents($conn);
        $conn->close();

        return view('Student.newClass', compact('students'));
    }

    public function addClass(Request $request)

    {

        $this->validate($request, [
            'student_id' => 'required',
            'class_id' => 'required'
        ]);
        $conn = DBConnection::openConnection();
        $classConnector = new ClassTableConnector();
        list($conn, $result) = $classConnector->getClassDetails($conn, $request->class_id);
        $enrollConnector = new EnrollTableConnector();

        $conn = $enrollConnector->enroll($conn, $request, $result);
        $conn->close();
        session()->flash('msg', 'Enrollment is successful.');
        return redirect()->back();

    }

    public function studentManagement()
    {

        //$studentConnector=new StudentTableConnector();
        //$namelist=$studentConnector->getName();
        $conn = DBConnection::openConnection();
        $studentConnector = new StudentTableConnector();

        list($conn, $students) = $studentConnector->getStudents($conn);
        $conn->close();

        return view('Student.studentManagement', compact('students'));
    }

    public function viewPayment($id)
    {
        // return $id;
        $conn = DBConnection::openConnection();

        $studentConnector = new StudentTableConnector();

        list($conn, $students) = $studentConnector->getStudents($conn);
        $studentPaymentConnector = new StudentPaymentsConnector();
        list($conn, $studentpayments) = $studentPaymentConnector->getStudentPayments($conn, $id);
        $conn->close();

        // return view('Student.singleStudentManagement')->with('students', $students,'id',$id);
        return view('Student.singleStudentManagement', compact('students', 'id', 'studentpayments'));
    }

    public function updateStudent(Request $request, $id)
    {
        return $request;
        $conn = DBConnection::openConnection();
        $studentConnector = new StudentTableConnector();


        $conn = $studentConnector->updateStudent($conn, $request);
        $conn->close();
        

        return view('Student.singleStudentManagement')->with('students', $students);
    }

    public function viewProgress(Request $request, $id)
    {

        $conn = DBConnection::openConnection();
        $studentConnector = new studentProgressConnector();

        list($conn, $studentprogress) = $studentConnector->getStudentProgress($conn, $id);
        $conn->close();


        return view('Student.viewProgress')->with('studentprogress', $studentprogress);
    }
}
