<?php
/**
 * Created by PhpStorm.
 * User: Dileka
 * Date: 12/10/2016
 * Time: 8:17 PM
 */

namespace app\DbModels;


use mysqli;

class StudentPaymentsConnector
{

    public function getStudentPayments(mysqli $conn, $enroll_id)
    {
        //$conn = DBConnection::openConnection();
        $sql = "SELECT `id`, `enroll_id`, `amount`, `note`, `created_at`, `updated_at` FROM `student_payments` WHERE `enroll_id`=$enroll_id";
        $result = $conn->query($sql);

        //$conn->close();
        $student_payments = array();

        while ($row = $result->fetch_assoc()) {
            array_push($student_payments, $row);
        }
        return [$conn, $student_payments];


    }


}