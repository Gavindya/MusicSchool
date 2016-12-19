<?php
/**
 * Created by PhpStorm.
 * User: Dileka
 * Date: 12/11/2016
 * Time: 9:55 AM
 */

namespace app\DbModels;

use mysqli;
use Symfony\Component\HttpFoundation\Request;


class EnrollDAO
{
    public function enroll(mysqli $conn, Request $request, Array $array)
    {


        //$conn = DBConnection::openConnection();
        //$sql="INSERT INTO `students` (`id`, `name`) VALUES (NULL,dileka)";
        $sql = "INSERT INTO `enrolls`(`id`, `student_id`, `class_id`, `active`, `created_at`, `updated_at`) VALUES (NULL ,'{$request->student_id}','{$request->class_id}','1',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
        $result = $conn->query($sql);
        //$conn->close();

        return $conn;


    }

    public function getEnrolmentsById(mysqli $conn, $student_id)
    {
        echo $student_id;
        $sql = "SELECT `id`, `student_id`, `class_id`, `active`, `created_at`, `updated_at` FROM `enrolls` WHERE `student_id`={$student_id}";
        $result = $conn->query($sql);

        //$conn->close();
        $student_enrolments = array();

        while ($row = $result->fetch_assoc()) {
            array_push($student_enrolments, $row);
        }
        return [$conn, $student_enrolments];
    }

    public function getEnrolmentId(mysqli $conn, $student_id, $class_id)
    {


        $sql = "SELECT `id` FROM `enrolls` WHERE `student_id`={$student_id} AND `class_id`={$class_id}";
        $result = $conn->query($sql);

        //$conn->close();
        $enrolment_id = array();

        while ($row = $result->fetch_assoc()) {
            array_push($enrolment_id, $row);
        }
        return [$conn, $enrolment_id];
    }

}