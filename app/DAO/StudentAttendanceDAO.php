<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:05 AM
 */

namespace App\DAO;

use App\Domain\Course;
use DB;


class StudentAttendanceDAO
{
    public function getAllAttendance()
    {
        return DB::select('SELECT * FROM attendance');
    }

    public function getAttendanceByEnrolment($enrolment_Id)
    {
        return DB::select('SELECT * FROM attendance WHERE enrolment_id = :id', ['id' => $enrolment_Id]);
    }

    public function addNewCourse(Course $course)
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

    public function updateCourse(Course $course)
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