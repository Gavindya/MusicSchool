<?php

namespace App\Http\Controllers;

use App\DAO\EnrolmentDAO;
use App\DAO\FeeDAO;
use App\DAO\GuardianDAO;
use App\DAO\ScoreDAO;
use App\DAO\StudentDAO;
use App\Domain\Enrolment;
use App\Domain\Guardian;
use App\Domain\Student;
use Illuminate\Http\Request;
use Session;

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

    public function showStudentsView()
    {
        $studentDAO = new StudentDAO();
        $students = $studentDAO->getAllStudentNames();
        return view('Student.studentManagement')->with('students', $students);
    }


    public function showNewStudentView()
    {
        return view('Student.new_student');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function enrolStudent(Request $request)

    {
        $this->validate($request, [
            'first_name', 'last_name' => 'required|min:2|max:45',
            'guardian_phone' => 'required|digits:10',
            'student_phone_number' => 'required|digits:10',
            'student_address' => 'required|max:45',
            'guardian_name' => 'required|min:2|max:45'
        ]);

        $object = $request->all();

        $guardianDAO = new GuardianDAO();
        $guardian = new Guardian($object['guardian_name'], $object['guardian_telephone']);
        $guardianDAO->addGuardian($guardian);

        $studentDAO = new StudentDAO();
        $student = new Student($object['student_name'], $object['student_address'], $object['student_telephone']);
        $studentDAO->addStudent($student);

        Session::flash('msg', 'Admission is successful.');
        return redirect()->back();
    }


    public function showStudentDetailsView()
    {
        $studentDAO = new StudentDAO();
        $students = $studentDAO->getAllStudents();
        return view('Student.viewStudentDetails')->with('students', $students);
    }

    public function showNewEnrolmentView()
    {
        $studentDAO = new StudentDAO();
        $students = $studentDAO->getAllStudents();
        return view('Student.newClass', compact('students'));
    }

    public function addNewEnrolment(Request $request)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'class_id' => 'required'
        ]);
        $object = $request->all();

        $enrolmentDAO = new EnrolmentDAO();
        $enrolment = new Enrolment($object['student_id'], $object['course_id']);
        $enrolmentDAO->addEnrolment($enrolment);

        Session::flash('msg', 'Enrollment is successful.');
        return redirect()->back();
    }

    public function showStudentManagementView()
    {
        //$studentDAO=new StudentTableConnector();
        //$namelist=$studentDAO->getName();
        $studentDAO = new StudentDAO();
        $students = $studentDAO->getAllStudents();
        return view('Student.studentManagement', compact('students'));
    }

    public function showStudentFeesView($enrolment_id)
    {
        $studentDAO = new StudentDAO();
        $students = $studentDAO->getAllStudents();
        $feeDAO = new FeeDAO();
        $fees = $feeDAO->getFees($enrolment_id);
        return view('Student.singleStudentManagement', compact('students', 'enrolment_id', 'studentpayments', $fees));
    }

    public function showStudentUpdateView(Request $request)
    {
        $studentDAO = new StudentDAO();
        $object = $request->all();
        $student = new Student($object['student_name'], $object['student_address'], $object['student_telephone']);
        $studentDAO->updateStudent($student);
        return view('Student.singleStudentManagement')->with('students', $student);
    }

    public function showStudentProgressView($enrolment_id)
    {
        $scoreDAO = new ScoreDAO();
        $studentProgress = $scoreDAO->getStudentProgress($enrolment_id);
        return view('Student.viewProgress')->with('studentprogress', $studentProgress);
    }
}
