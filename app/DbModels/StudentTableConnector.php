<?php
/**
 * Created by PhpStorm.
 * User: Dileka
 * Date: 12/7/2016
 * Time: 9:58 PM
 */

namespace app\DbModels;


use App\DbConnection\DBConnection;
use Symfony\Component\HttpFoundation\Request;


class StudentTableConnector
{


    /**
     * @return array
     */
    public function getName()
    {
        $conn = DBConnection::openConnection();
        $sql = "SELECT students.name FROM students";
        $result = $conn->query($sql);
        $conn->close();
        $students = array();
        while ($row = $result->fetch_assoc()) {
            array_push($students, $row['name']);
        }
        return $students;


    }

    public function storeStudent(Request $request)
    {
        $conn = DBConnection::openConnection();
        //$sql="INSERT INTO `students` (`id`, `name`) VALUES (NULL,dileka)";
        $sql = "INSERT INTO `students`(`id`, `name`, `address`, `telephone`, `family_id`, `created_at`, `updated_at`) VALUES (NULL ,'{$request->first_name}','{$request->student_address}','{$request->student_telephone}','1',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function getStudents()
    {
        $conn = DBConnection::openConnection();
        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);
        $conn->close();
        $students = array();

        while ($row = $result->fetch_assoc()) {

            array_push($students, $row);
        }
        return $students;

    }

    public function updateStudent(Request $student)
    {
        $conn = DBConnection::openConnection();
        //$sql="INSERT INTO `students` (`id`, `name`) VALUES (NULL,dileka)";
        $sql = "UPDATE `students` SET `name` = '{$student->name}', `address` = '{$student->address}', `telephone` = '{$student->telephone}', `family_id` = '{$student->family_id}' ,`updated_at` = CURRENT_TIMESTAMP WHERE `students`.`id` = {$student->id}";
        $result = $conn->query($sql);
        $conn->close();
        return $result;

    }

}