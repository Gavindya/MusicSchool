<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:06 AM
 */

namespace app\DAO;

use App\VO\AttendanceVO;
use DB;

class AttendanceDAO
{
    public function getAttendance($course_id)
    {
        return DB::select(
            'SELECT * FROM attendance WHERE enrolment_id IN (SELECT enrolment_id FROM enrolments WHERE course_id = :course_id)', [
            'course_id' => $course_id
        ]);
    }

    public function addAttendance($enrolment_id)
    {
        DB::insert(
            'INSERT INTO attendance (enrolment_id, date) VALUES (:enrolment_id, CURRENT_DATE)', [
            'enrolment_id' => $enrolment_id
        ]);
    }
}