<?php

namespace App\Http\Controllers;

use App\DAO\CourseDAO;
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
        $search = 0;
        return view('Student.studentManagement')->with('students', $students, 'search', $search);
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
            'student_firstname', 'student_lastname' => 'required|min:2|max:45',
            'guardian_telephone' => 'required|digits:10',
            'student_telephone' => 'required|digits:10',
            'student_address' => 'required|max:45',
            'guardian_name' => 'required|min:2|max:45'
        ]);

        $object = $request->all();

        $guardianDAO = new GuardianDAO();
        $guardian = new Guardian($object['guardian_name'], $object['guardian_telephone']);
        $guardianDAO->addGuardian($guardian);

        $studentDAO = new StudentDAO();
        $student = new Student($object['student_firstname'], $object['student_lastname'], $object['student_address'], $object['student_telephone']);
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
        $courseDAO = new CourseDAO();
        $students = $studentDAO->getAllStudents();
        $courses = $courseDAO->getAllCourses();
        $search = 0;
//        echo dd($students);
        return view('Student.newClass', compact('students', 'search', 'courses'));
    }

    public function addNewEnrolment(Request $request)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'course_id' => 'required'
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
        $search = 0;
        return view('Student.studentManagement', compact('students', 'search'));
    }

    public function showStudentFeesView($id)
    {
        $studentDAO = new StudentDAO();
        $students = $studentDAO->getAllStudents();
        $feeDAO = new FeeDAO();
        $studentpayments = $feeDAO->getFees($id);
        return view('Student.singleStudentManagement', compact('students', 'id', 'studentpayments'));
    }


    public function searchStudentsForManagement(Request $request)
    {


        $studentDAO = new StudentDAO();


        $students = $studentDAO->searchStudents($request);
        $search = 1;
        return view('Student.studentManagement', compact('students', 'search'));


    }


    public function showStudentUpdateView(Request $request)
    {
        $studentDAO = new StudentDAO();
        $object = $request->all();
        $student = new Student($object['student_firstname'], $object['student_lastname'], $object['student_address'], $object['student_telephone']);
        $studentDAO->updateStudent($student);
        session()->flash('msg', 'Update is successful.');
        $search = 0;

        return view('Student.studentManagement', compact('students', 'search'));
    }

    public function showStudentProgressView($id)

    {

        $scoreDAO = new ScoreDAO();

        $studentprogress = $scoreDAO->getStudentProgress($id);

        return view('Student.viewProgress', compact('studentprogress', 'id'));
    }
}
