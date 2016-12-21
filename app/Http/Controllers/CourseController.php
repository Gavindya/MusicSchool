<?php

namespace App\Http\Controllers;

use App\DAO\AssignmentDAO;
use App\DAO\CourseDAO;
use App\DAO\InstrumentDAO;
use App\DAO\TeacherDAO;
use App\DAO\TimeslotDAO;
use App\Domain\Course;
use App\Domain\StudentAssignment;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
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

    public function getAllTeachers()
    {
        return DB::select('SELECT teacher_id, teacher_name FROM teachers');
    }

    public function getAllInstruments()
    {
        return DB::select('SELECT instrument_id, instrument_name FROM instruments');
    }

    public function showCourseManagement()
    {
        $courseDAO = new CourseDAO();
        $instrumentDAO = new InstrumentDAO();
        $timeslotDAO = new TimeslotDAO();
        $teacherDAO = new TeacherDAO();

        $courses = $courseDAO->getAllCourses();
        $instruments = $instrumentDAO->getAllInstruments();
        $timeslots = $timeslotDAO->getAllTimeslots();
        $teachers = $teacherDAO->getAllTeachersAsObj();

        return view('courses.course-management', [
            'courses' => $courses,
            'instruments' => $instruments,
            'timeslots' => $timeslots,
            'teachers' => $teachers
        ]);
    }

    public function showCourseDetails($id)
    {
        $courseDAO = new CourseDAO();
        $instrumentDAO = new InstrumentDAO();
        $timeslotDAO = new TimeslotDAO();
        $teacherDAO = new TeacherDAO();
        $assignmentDAO = new AssignmentDAO();

        $course = $courseDAO->getCourseByCourseId($id);
        $instrument = $instrumentDAO->getInstrumentById($course->instrument_id);
        $timeslot = $timeslotDAO->getTimeslotById($course->timeslot_id);
        $teacher = $teacherDAO->getTeacherById($course->teacher_id);

        $instruments = $instrumentDAO->getAllInstruments();
        $timeslots = $timeslotDAO->getAllTimeslots();
        $teachers = $teacherDAO->getAllTeachersAsObj();
        $assignments = $assignmentDAO->getAssignments($course->course_id);

        return view('courses.course-details')->with([
            'course' => $course,
            'instrument' => $instrument,
            'timeslot' => $timeslot,
            'teacher' => $teacher,
            'instruments' => $instruments,
            'timeslots' => $timeslots,
            'teachers' => $teachers,
            'assignments' => $assignments
        ]);
    }

    public function addCourse(Request $request)
    {
        $object = $request->all();
        $courseDAO = new CourseDAO();
        $courseDAO->addNewCourse(new Course(
            $object['course_name'],
            $object['instrument_id'],
            $object['credits'],
            $object['weekday'],
            $object['timeslot_id'],
            $object['charges'],
            $object['teacher_id']));

        return redirect()->back();
    }

    public function addAssignment(Request $request)
    {
        $object = $request->all();
        $assignmentDAO = new AssignmentDAO();
        $assignmentDAO->addAssignment(new StudentAssignment(
            $object['course_id'],
            $object['title'],
            $object['marks']));

        return redirect()->back();
    }

    public function editCourse(Request $request)
    {
        $object = $request->all();
        $courseDAO = new CourseDAO();
        $course = new Course(
            $object['course_name'],
            $object['instrument_id'],
            $object['credits'],
            $object['weekday'],
            $object['timeslot_id'],
            $object['charges'],
            $object['teacher_id']);
        $course->course_id = $object['course_id'];
        $courseDAO->updateCourse($course);
        return redirect()->back();
    }

    public function getAssignedCourseDetails($id)
    {
        $clsDetails = array();
        array_push($clsDetails, 1);
        array_push($clsDetails, $id);
        array_push($clsDetails, 2);
        array_push($clsDetails, 1500);
        array_push($clsDetails, "4:30");
        array_push($clsDetails, "6:30");
        return $clsDetails;
    }
}