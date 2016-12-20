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
    public function getClassAttendance($course_id)
    {
        return DB::select(
            'SELECT
                enrolments.enrolment_id AS enrollment_id,
                enrolments.is_active    AS status,
                enrolments.student_id   AS student_id,
                attendance.date         AS date,
                student_name,
                course_name
            FROM
              enrolments
              NATURAL JOIN
              students
              NATURAL JOIN
              courses
              LEFT JOIN
              attendance USING (enrolment_id)
            WHERE enrolments.course_id = :courseId', [
            'courseId' => $course_id
        ]);
    }

    public function getStudentAttendance($student_id)
    {
        return DB::select(
            'SELECT
                enrolments.enrolment_id AS enrollment_id,
                enrolments.is_active    AS status,
                enrolments.student_id   AS student_id,
                attendance.date         AS date,
                student_name,
                course_name
            FROM
              enrolments
              NATURAL JOIN
              students
              NATURAL JOIN
              courses
              LEFT JOIN
              attendance USING (enrolment_id)
            WHERE student_id = :studentId', [
            'studentId' => $student_id
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