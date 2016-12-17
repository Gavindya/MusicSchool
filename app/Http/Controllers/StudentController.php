<?php

namespace App\Http\Controllers;

use App\DAO\ConnectionManager;
use App\DAO\CourseDAO;
use App\DAO\GuardianDAO;
use App\DAO\ScoreDAO;
use App\DAO\StudentDAO;
use Illuminate\Http\Request;

class StudentController extends Controller
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

    public function getAllStudentNames()
    {
        $studentConnector = new StudentDAO();
        list($students) = $studentConnector->getAllStudentNames();
        return view('welcome')->with('students', $students);
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

        $conn = ConnectionManager::getConnection();

        $guardianConnector = new GuardianDAO();
        $result = $guardianConnector->addGuardian($conn, $request);

        $studentConnector = new StudentDAO();

        $result2 = $studentConnector->addStudent($result, $request);

        session()->flash('msg', 'Admission is successful.');
        return redirect()->back();
        //return Redirect::back()->with('msg', 'The Message');
    }


    public function getStudents()
    {
        $conn = ConnectionManager::getConnection();
        $studentConnector = new StudentDAO();

        list($conn, $students) = $studentConnector->getAllStudents($conn);
        $conn->close();

        return view('Student.viewStudentDetails')->with('students', $students);
        //return view('welcome');

    }

    public function addNewClass()
    {
        $conn = ConnectionManager::getConnection();
        $studentConnector = new StudentDAO();
        list($conn, $students) = $studentConnector->getAllStudents($conn);
        $conn->close();

        return view('Student.newClass', compact('students'));
    }

    public function addClass(Request $request)

    {

        $this->validate($request, [
            'student_id' => 'required',
            'class_id' => 'required'
        ]);
        $conn = ConnectionManager::getConnection();
        $classConnector = new CourseDAO();
        list($conn, $result) = $classConnector->getClassDetails($conn, $request->class_id);
        $enrollConnector = new EnrolmentsTableConnector();

        $conn = $enrollConnector->enroll($conn, $request, $result);
        $conn->close();
        session()->flash('msg', 'Enrollment is successful.');
        return redirect()->back();

    }

    public function studentManagement()
    {

        //$studentConnector=new StudentTableConnector();
        //$namelist=$studentConnector->getName();
        $conn = ConnectionManager::getConnection();
        $studentConnector = new StudentDAO();

        list($conn, $students) = $studentConnector->getAllStudents($conn);
        $conn->close();

        return view('Student.studentManagement', compact('students'));
    }

    public function viewPayment($id)
    {
        // return $id;
        $conn = ConnectionManager::getConnection();

        $studentConnector = new StudentDAO();

        list($conn, $students) = $studentConnector->getAllStudents($conn);
        $studentPaymentConnector = new StudentPaymentsConnector();
        list($conn, $studentpayments) = $studentPaymentConnector->getStudentPayments($conn, $id);
        $conn->close();

        // return view('Student.singleStudentManagement')->with('students', $students,'id',$id);
        return view('Student.singleStudentManagement', compact('students', 'id', 'studentpayments'));
    }

    public function updateStudent(Request $request, $id)
    {
        $conn = ConnectionManager::getConnection();
        $studentConnector = new StudentDAO();


        $conn = $studentConnector->updateStudent($conn, $request);
        $conn->close();


        return view('Student.singleStudentManagement')->with('students', $students);
    }

    public function viewProgress(Request $request, $id)
    {

        $conn = ConnectionManager::getConnection();
        $studentConnector = new ScoreDAO();

        list($conn, $studentprogress) = $studentConnector->getStudentProgress($conn, $id);
        $conn->close();


        return view('Student.viewProgress')->with('studentprogress', $studentprogress);
    }
}
