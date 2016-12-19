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
        $conn = ConnectionManager::getPDO();
        $sql = "SELECT student_name FROM students";
        return $conn->query($sql)->fetchAll();
    }

    public function addStudent(Student $student): bool
    {
        $conn = ConnectionManager::getPDO();
        $sql = "INSERT INTO students (student_name, student_address, student_telephone) VALUES (:student_name, :student_address, :student_telephone)";
        $statement = $conn->prepare($sql);
        return $statement->execute([
            ':student_name' => $student->student_name,
            ':student_address' => $student->student_address,
            ':student_telephone' => $student->student_telephone
        ]);
    }

    public function getAllStudents(): array
    {
        $conn = ConnectionManager::getPDO();
        $sql = "SELECT * FROM students";
        return $conn->query($sql)->fetchAll();

    }

    public function updateStudent(Student $student): bool
    {
        $conn = ConnectionManager::getPDO();
        $sql = "UPDATE students SET student_name = :student_name, student_telephone = :student_telephone, student_address = :student_address WHERE student_id = :student_id";
        $statement = $conn->prepare($sql);
        return $statement->execute([
            ':student_name' => $student->student_name,
            ':student_telephone' => $student->student_telephone,
            ':student_address' => $student->student_address,
            ':student_id' => $student->student_id
        ]);
    }
}