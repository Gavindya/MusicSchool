<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:05 AM
 */

namespace App\DAO;

use App\Domain\Enrolment;
use DB;

class EnrolmentDAO
{
    public function getEnrolment($studentId, $courseId): array
    {
        return DB::select(
            'SELECT * FROM enrolments WHERE student_id = :studentId AND course_id = :courseId', [
            'studentId' => $studentId,
            'courseId' => $courseId
        ]);
    }

    public function addEnrolment(Enrolment $enrolment): bool
    {
        $conn = ConnectionManager::getConnection();
        $sql = "INSERT INTO enrolments (student_id, course_id) VALUES (:student_id, :course_id)";
        $statement = $conn->statement($sql, [
            'student_id' => $enrolment->student_id,
            'course_id' => $enrolment->course_id
        ]);
        return $conn->getPdo()->exec($statement);
    }
}