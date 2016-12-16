<?php

namespace App\Http\Controllers;

use App\DAO\CourseDAO;

class CourseController extends Controller
{
    public function showCourseManagement()
    {
        $courseDAO = new CourseDAO();
        $courses = $courseDAO->getAllCourses();
        return view('courses.coursemanagement', ['courses' => json_decode(json_encode($courses), TRUE)]);
    }

    public function showCourseDetails($id)
    {
        $courseDAO = new CourseDAO();
        $course = $courseDAO->getCourseById($id);
        return view('courses.coursedetails', ['course' => get_object_vars($course[0])]);
    }
}