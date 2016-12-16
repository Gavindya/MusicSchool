<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:05 AM
 */

namespace App\DAO;


class StudentAttendanceDAO
{
    public function getAllAttendance($enrollmentId)
    {
        return DB::select('SELECT * FROM student_attendance');
    }

    public function getCourseById($enrollmentId){
        return DB::select('SELECT * FROM student_attendance WHERE enrollment_id = :id AND date >= ', ['id' => $id]);
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