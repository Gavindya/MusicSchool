<?php
/**
 * Created by PhpStorm.
 * User: Dileka
 * Date: 12/11/2016
 * Time: 7:10 AM
 */

namespace app\DbModels;


use mysqli;

class studentProgressConnector
{
    public function getStudentProgress(mysqli $conn, $enroll_id)
    {
        // $conn = DBConnection::openConnection();
        $sql = "SELECT `id`, `enroll_id`, `grade`, `remarks`, `created_at`, `updated_at` FROM `student_progress` WHERE `enroll_id`=$enroll_id";
        $result = $conn->query($sql);

        //$conn->close();
        $student_progress = array();

        while ($row = $result->fetch_assoc()) {
            array_push($student_progress, $row);
        }
        return [$conn, $student_progress];


    }


}