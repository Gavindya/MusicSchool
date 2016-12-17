<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:05 AM
 */

namespace App\DAO;


class EnrolmentDAO
{
    public function getStudentEnrollment($studentId, $courseId){
        DB::select(
            'SELECT * FROM enrolments WHERE student_id = :studentId AND course_id = :courseId',[
            'studentId' => $studentId,
            'courseId' => $courseId
        ]);
    }
}