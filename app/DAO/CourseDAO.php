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

    public function getCourseById(int $id)
    {
        return DB::selectOne('SELECT * FROM course_details WHERE course_id = :id', ['id' => $id]);
    }

    public function addNewCourse(CourseVO $course)
    {
        return DB::insert(
            'INSERT INTO courses (course_name, instrument_id, weekday, timeslot_id, charges, teacher_id) VALUES (:course_name, :instrument_id, :weekday, :timeslot_id, :charges, :teacher_id)', [
            'course_name' => $course->course_name,
            'instrument_id' => $course->instrument_id,
            'weekday' => $course->weekday,
            'timeslot_id' => $course->timeslot_id,
            'charges' => $course->charges,
            'teacher_id' => $course->teacher_id
        ]);
    }

    public function updateCourse(CourseVO $course)
    {
        return DB::update(
            'UPDATE courses SET course_name = :course_name, instrument_id = :instrument_id, weekday = :weekday, timeslot_id = :timeslot_id, charges = :charges, teacher_id = :teacher_id WHERE course_id = :course_id', [
            'course_name' => $course->course_name,
            'instrument_id' => $course->instrument_id,
            'weekday' => $course->weekday,
            'timeslot_id' => $course->timeslot_id,
            'charges' => $course->charges,
            'teacher_id' => $course->teacher_id,
            'course_id' => $course->course_id
        ]);
    }
}