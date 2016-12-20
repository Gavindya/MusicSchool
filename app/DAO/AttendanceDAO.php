<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:06 AM
 */

namespace app\DAO;

use App\DAO\ConnectionManager;
use DB;
use League\Flysystem\Exception;

class AttendanceDAO
{
    public function getClassAttendance($course_id,$date): array
    {
        $conn = ConnectionManager::getConnection();
        $sql = 'SELECT
                    enrolments.is_active    AS status,
                    enrolments.student_id   AS student_id,
                    t1.date         AS date,
                    student_firstname,
                    student_lastname
                FROM enrolments
                LEFT JOIN ((SELECT * FROM attendance WHERE date = :date) as t1) USING (enrolment_id)
                NATURAL JOIN students
                WHERE course_id = :courseId';
        $statement = $conn->getPdo()->prepare($sql);
        $statement->bindParam('courseId',$course_id);
        $statement->bindParam('date',$date);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getClassAttendancePresent($course_id,$date): array
    {
        $conn = ConnectionManager::getConnection();
        $sql = 'SELECT
                    enrolments.is_active    AS status,
                    enrolments.student_id   AS student_id,
                    t1.date         AS date,
                    student_firstname,
                    student_lastname
                FROM enrolments
                LEFT JOIN ((SELECT * FROM attendance WHERE date = :date) as t1) USING (enrolment_id)
                NATURAL JOIN students
                WHERE course_id = :courseId AND date IS NOT NULL;';
        $statement = $conn->getPdo()->prepare($sql);
        $statement->bindParam('courseId',$course_id);
        $statement->bindParam('date',$date);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getClassAttendanceAbsent($course_id,$date): array
    {
        $conn = ConnectionManager::getConnection();
        $sql = 'SELECT
                    enrolments.is_active    AS status,
                    enrolments.student_id   AS student_id,
                    t1.date         AS date,
                    student_firstname,
                    student_lastname
                FROM enrolments
                LEFT JOIN ((SELECT * FROM attendance WHERE date = :date) as t1) USING (enrolment_id)
                NATURAL JOIN students
                WHERE course_id = :courseId AND date IS NULL;';
        $statement = $conn->getPdo()->prepare($sql);
        $statement->bindParam('courseId',$course_id);
        $statement->bindParam('date',$date);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getStudentAttendance($student_id): array
    {
        $conn = ConnectionManager::getConnection();
        $sql = 'SELECT
                  enrolments.is_active    AS status,
                  date,
                  course_name
                FROM enrolments
                NATURAL JOIN attendance
                NATURAL JOIN courses
                WHERE student_id = :studentId';
        $statement = $conn->getPdo()->prepare($sql);
        $statement->bindParam('studentId',$student_id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getEnrolledStudents($courseId) : array
    {
        $sql = 'SELECT  enrolment_id,
                        is_active AS status,
                        students.student_id as student_id,
                        student_firstname,
                        student_lastname FROM enrolments 
                NATURAL JOIN students 
                WHERE enrolments.course_id = :courseId;';
        $conn = ConnectionManager::getConnection();
        $statement = $conn->getPdo()->prepare($sql);
        $statement->bindParam('courseId',$courseId);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function addAttendance($present): bool
    {
        $sql = 'INSERT INTO attendance (enrolment_id, date) VALUES (:enrolment_id, CURRENT_DATE)';
        $conn = ConnectionManager::getConnection();
        $conn->beginTransaction();
        $statement = $conn->getPdo()->prepare($sql);
        foreach ($present as $enrolmentId){
            $statement->bindParam('enrolment_id',$enrolmentId);
            $statement->execute();
        }
        $conn->commit();
        return true;
    }
}