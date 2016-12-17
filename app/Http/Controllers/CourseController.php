<?php

namespace App\Http\Controllers;

use App\DAO\CourseDAO;
use App\DAO\InstrumentDAO;
use App\DAO\TeacherDAO;
use App\DAO\TimeslotDAO;
use App\VO\CourseVO;
use Illuminate\Http\Request;

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

    public function showCourseManagement()
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
            'courses' => json_decode(json_encode($courses), TRUE),
            'instruments' => json_decode(json_encode($instruments), TRUE),
            'timeslots' => json_decode(json_encode($timeslots), TRUE),
            'teachers' => json_decode(json_encode($teachers), TRUE)
        ]);
    }

    public function showCourseDetails($id)
    {
        $courseDAO = new CourseDAO();
        $instrumentDAO = new InstrumentDAO();
        $timeslotDAO = new TimeslotDAO();
        $teacherDAO = new TeacherDAO();

        $course = $courseDAO->getCourseById($id);
        $instrument = $instrumentDAO->getInstrumentById($course->instrument_id);
        $timeslot = $timeslotDAO->getTimeslotById($course->timeslot_id);
        $teacher = $teacherDAO->getTeacherById($course->teacher_id);

        $instruments = $instrumentDAO->getAllInstruments();
        $timeslots = $timeslotDAO->getAllTimeslots();
        $teachers = $teacherDAO->getAllTeachers();

        return view('courses.course-details')->with([
            'course' => get_object_vars($course),
            'instrument' => get_object_vars($instrument),
            'timeslot' => json_decode(json_encode($timeslot), TRUE),
            'teacher' => json_decode(json_encode($teacher), TRUE),
            'instruments' => json_decode(json_encode($instruments), TRUE),
            'timeslots' => json_decode(json_encode($timeslots), TRUE),
            'teachers' => json_decode(json_encode($teachers), TRUE)

        ]);
    }

    public function addCourse(Request $request)
    {
        $object = $request->all();
        $courseDAO = new CourseDAO();

        $courseDAO->addNewCourse(new CourseVO(
            $object['course_name'],
            $object['instrument_id'],
            $object['credits'],
            $object['weekday'],
            $object['timeslot_id'],
            $object['charges'],
            $object['teacher_id']));

        return redirect()->back();
    }

    public function editCourse(Request $request)
    {
        $object = $request->all();
        $courseDAO = new CourseDAO();
        $course = new CourseVO(
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
}