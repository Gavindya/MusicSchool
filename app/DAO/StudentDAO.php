<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:05 AM
 */

namespace App\DAO;


use App\Domain\Student;
use Symfony\Component\HttpFoundation\Request;

class StudentDAO
{
    /**
     * @return array
     */
    public function getAllStudentNames()
    {
        $conn = ConnectionManager::getPDO();
        $sql = "SELECT student_firstname FROM students";
        return $conn->query($sql)->fetchAll();
    }

    public function addStudent(Student $student)
    {
        $conn = ConnectionManager::getPDO();
        $sql = "INSERT INTO students (student_firstname,student_lastname, student_address, student_telephone) VALUES (:student_firstname,:student_lastname, :student_address, :student_telephone)";
        $statement = $conn->prepare($sql);
        return $statement->execute([
            ':student_firstname' => $student->student_firstname,
            ':student_lastname' => $student->student_firstname,
            ':student_address' => $student->student_address,
            ':student_telephone' => $student->student_telephone
        ]);
    }

    public function getAllStudents()
    {
        $conn = ConnectionManager::getPDO();
        $sql = "SELECT * FROM students";
        return $conn->query($sql)->fetchAll();

    }

    public function updateStudent(Student $student)
    {
        $conn = ConnectionManager::getPDO();
        $sql = "UPDATE students SET student_firstname = :student_name, student_telephone = :student_telephone, student_address = :student_address WHERE student_id = :student_id";
        $statement = $conn->prepare($sql);
        return $statement->execute([
            ':student_name' => $student->student_firstname,
            ':student_telephone' => $student->student_telephone,
            ':student_address' => $student->student_address,
            ':student_id' => $student->student_id
        ]);
    }


    public function searchStudents(Request $request)
        
    {

       // $word = "%{$request->guess}%";
       // $sql = "SELECT * FROM `students` WHERE `name` LIKE '{$word}' ";

        $conn = ConnectionManager::getPDO();
        $word = "%{$request->guess}%";
        //  echo( '%'.$request->guess}.'%');

         $sql = "SELECT * FROM `students` WHERE `student_firstname` LIKE $word";
//       // $statement = $conn->prepare($sql);
//        echo "%{$request->guess}%";
//        return $statement->execute([
//            ':guess' => "%{$request->guess}%"]);




        $word = "%{$request->guess}%";
        $sql = "SELECT * FROM `students` WHERE `student_firstname` LIKE '{$word}' ";
        $result = $conn->query($sql);
        // $conn->close();

        return $conn->query($sql)->fetchAll();
        var_dump($conn->query($sql)->fetchAll());

//       //


    }


    public function getStudentProgress($student_id)
    {

        // $conn = DBConnection::openConnection();
        $conn = ConnectionManager::getPDO();
        $sql = "SELECT students.student_id, enrolments.enrolment_id, scores.assignment_id,assignments.asignment_title,scores.score FROM `students` JOIN `enrolments` ON students.student_id=enrolments.student_id JOIN scores on scores.enrolment_id=enrolments.enrolment_id join assignments on scores.assignment_id=assignments.assignment_id where students.student_id= :std_id";
        $statement = $conn->prepare($sql);
        return $statement->execute([
            ':std_id' => $student_id

        ]);

    }
    
    
    
}