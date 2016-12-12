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


class EnrollTableConnector
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


}