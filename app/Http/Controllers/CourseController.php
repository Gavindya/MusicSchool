<?php

namespace App\Http\Controllers;

use App\DAO\CourseDAO;
use App\DAO\InstrumentDAO;
use App\DAO\TeacherDAO;
use App\DAO\TimeslotDAO;
use App\Domain\Course;
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

    public function showCourseManagement(): View
    {
        $courseDAO = new CourseDAO();
        $instrumentDAO = new InstrumentDAO();
        $timeslotDAO = new TimeslotDAO();
        $teacherDAO = new TeacherDAO();

        $courses = $courseDAO->getAllCourses();
        $instruments = $instrumentDAO->getAllInstruments();
        $timeslots = $timeslotDAO->getAllTimeslots();
        $teachers = $teacherDAO->getAllTeachers();

        return view('courses.course-management', [
            'courses' => $courses,
            'instruments' => $instruments,
            'timeslots' => $timeslots,
            'teachers' => $teachers
        ]);
    }

    public function showCourseDetails($id): View
    {
        $courseDAO = new CourseDAO();
        $instrumentDAO = new InstrumentDAO();
        $timeslotDAO = new TimeslotDAO();
        $teacherDAO = new TeacherDAO();

        $course = $courseDAO->getCourseByCourseId($id);
        $instrument = $instrumentDAO->getInstrumentById($course->instrument_id);
        $timeslot = $timeslotDAO->getTimeslotById($course->timeslot_id);
        $teacher = $teacherDAO->getTeacherById($course->teacher_id);

        $instruments = $instrumentDAO->getAllInstruments();
        $timeslots = $timeslotDAO->getAllTimeslots();
        $teachers = $teacherDAO->getAllTeachers();

        return view('courses.course-details')->with([
            'course' => $course,
            'instrument' => $instrument,
            'timeslot' => $timeslot,
            'teacher' => $teacher,
            'instruments' => $instruments,
            'timeslots' => $timeslots,
            'teachers' => $teachers,
        ]);
    }

    public function addCourse(Request $request): RedirectResponse
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

    public function editCourse(Request $request): RedirectResponse
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