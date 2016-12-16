<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:06 AM
 */

namespace app\DAO;

use DB;

class AttendanceDAO
{
    public function getClassAttendance($course_id, $date)
    {
        return DB::select(
            'SELECT * FROM attendance WHERE enrolment_id IN (SELECT enrolment_id FROM enrolments WHERE course_id = :course_id) AND attendance.date = :date', [
            'course_id' => $course_id,
            'date' => $date
        ]);
    }

    public function getStudentAttendance($studentId, $rowLimit){
        return DB::select(
            'SELECT * FROM attendance WHERE enrolment_id = :enrollmentId ORDER BY date DESC LIMIT :rowLimit',[
                'enrollmentId'=>$studentId,
                'rowLimit' => $rowLimit
        ]);
    }

    public function getAttendance($enrollmentId){
        return DB::select('SELECT * FROM attendance WHERE enrolment_id = :enrollmentId',[
            'enrollmentId'=>$enrollmentId
        ]);
    }

    public function insertAttendance($enrolmentId)
    {
        DB::insert(
            'INSERT INTO attendance (enrolment_id, date) VALUES (:enrolment_id, CURRENT_DATE)', [
            'enrolment_id' => $enrolmentId
        ]);
    }
}