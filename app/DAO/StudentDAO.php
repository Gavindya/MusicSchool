<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:05 AM
 */

namespace App\DAO;


use App\Domain\Student;

class StudentDAO
{
    /**
     * @return array
     */
    public function getAllStudentNames(): array
    {
        $conn = ConnectionManager::getConnection();
        $sql = "SELECT student_name FROM students";
        $result = $conn->getPdo()->query($sql);
        //$conn->close();
        $students = array();
        while ($row = $result->fetch()) {
            array_push($students, $row['name']);
        }
        return $students;


    }

    public function addStudent(Student $student): bool
    {
        $conn = ConnectionManager::getConnection();
        $sql = "INSERT INTO students (student_name, student_address, student_telephone) VALUES (:student_name, :student_address, :student_telephone)";
        $conn->statement($sql, [
            'student_name' => $student->student_name,
            'student_address' => $student->student_address,
            'student_telephone' => $student->student_telephone
        ]);
        return $conn->getPdo()->exec($sql);
    }

    public function getAllStudents(): array
    {
        $conn = ConnectionManager::getConnection();
        $sql = "SELECT * FROM students";
        return $conn->getPdo()->query($sql)->fetchAll();

    }

    public function updateStudent(Student $student): int
    {
        $conn = ConnectionManager::getConnection();
        $sql = "UPDATE students SET student_name = :student_name, student_telephone = :student_telephone, student_address = :student_address WHERE student_id = :student_id";
        $statement = $conn->statement($sql, [
            'student_name' => $student->student_name,
            'student_telephone' => $student->student_telephone,
            'student_address' => $student->student_address,
            'student_id' => $student->student_id
        ]);
        return $conn->getPdo()->exec($statement);
    }
}