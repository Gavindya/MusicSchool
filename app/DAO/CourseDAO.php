<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:03 AM
 */

namespace App\DAO;

use App\Domain\Course;
use DB;
use stdClass;


class CourseDAO
{

    public function getAllCourses(): array
    {
        return DB::select('SELECT * FROM course_details');
    }

    public function getCourseByCourseId($id): stdClass
    {
        return DB::selectOne('SELECT * FROM course_details WHERE course_id = :id', ['id' => $id]);
    }

    public function getCoursesOfTeacher($id)
    {
        $courseDetails = DB::select('SELECT * FROM course_details WHERE teacher_id = :id', ['id' => $id]);
        $courseDetails = json_decode(json_encode($courseDetails), TRUE);
        return $courseDetails;
    }

    public function addNewCourse(Course $course): bool
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

    public function updateCourse(Course $course): int
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