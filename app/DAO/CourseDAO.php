<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:03 AM
 */

namespace App\DAO;

use App\VO\CourseVO;
use DB;


class CourseDAO
{

    public function getAllCourses()
    {
        return DB::select('SELECT * FROM course_details');
    }

    public function getCourseById($id){
        return DB::select('SELECT * FROM course_details WHERE course_id = :id', ['id' => $id]);
    }

    public function addNewCourse(CourseVO $course)
    {
        return DB::insert(
            'INSERT INTO courses (instrument_id, weekday, timeslot_id, charges, teacher_id) VALUES (:instrument_id, :weekday, :timeslot_id, :charges, :teacher_id)', [
            'instrument_id' => $course->getInstrumentId(),
            'weekday' => $course->getWeekday(),
            'timeslot_id' => $course->getTimeslotId(),
            'charges' => $course->getCharges(),
            'teacher_id' => $course->getTeacherId()
        ]);
    }

    public function updateCourse(CourseVO $course)
    {
        return DB::update(
            'UPDATE courses SET instrument_id = :instrument_id, weekday = :weekday, timeslot_id = :timeslot_id, charges = :charges, teacher_id = :teacher_id WHERE course_id = :course_id', [
            'instrument_id' => $course->getInstrumentId(),
            'weekday' => $course->getWeekday(),
            'timeslot_id' => $course->getTimeslotId(),
            'charges' => $course->getCharges(),
            'teacher_id' => $course->getTeacherId(),
            'course_id' => $course->getCourseId()
        ]);
    }
}