<?php
/**
 * Created by PhpStorm.
 * User: Dileka
 * Date: 12/7/2016
 * Time: 9:58 PM
 */

namespace app\DbModels;


use mysqli;
use Symfony\Component\HttpFoundation\Request;


class StudentTableConnector
{


    /**
     * @return array
     */
    public function getName(mysqli $conn)
    {

        $sql = "SELECT students.name FROM students";
        $result = $conn->query($sql);
        //$conn->close();
        $students = array();
        while ($row = $result->fetch_assoc()) {
            array_push($students, $row['name']);
        }
        return [$conn, $students];


    }

    public function storeStudent(mysqli $conn, Request $request)
    {


        $sql = "INSERT INTO `students`(`id`, `name`, `address`, `telephone`, `family_id`, `created_at`, `updated_at`) VALUES (NULL ,'{$request->first_name}','{$request->student_address}','{$request->student_phone_number}','1',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
        $result = $conn->query($sql);


        return $conn;
    }

    public function getStudents(mysqli $conn)
    {
        // $conn = DBConnection::openConnection();
        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);
        // $conn->close();
        $students = array();

        while ($row = $result->fetch_assoc()) {

            array_push($students, $row);
        }
        return [$conn, $students];

    }

    public function updateStudent(mysqli $conn, Request $student)
    {

        $sql = "UPDATE `students` SET `name` = '{$student->name}', `address` = '{$student->address}', `telephone` = '{$student->telephone}', `family_id` = '4' ,`updated_at` = CURRENT_TIMESTAMP WHERE `students`.`id` = {$student->id}";
        $result = $conn->query($sql);
        //$conn->close();
        return $conn;

    }

}