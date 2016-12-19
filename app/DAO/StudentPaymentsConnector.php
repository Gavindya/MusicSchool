<?php
/**
 * Created by PhpStorm.
 * User: Dileka
 * Date: 12/10/2016
 * Time: 8:17 PM
 */

namespace app\DbModels;


use Illuminate\Http\Request;
use mysqli;

class StudentPaymentsConnector
{

    public function getStudentPayments(mysqli $conn, $student_id)
    {
        //$conn = DBConnection::openConnection();
        $sql = "SELECT * FROM fees JOIN enrolls on fees.enrolment_id=enrolls.id where enrolls.student_id=$student_id";
        $result = $conn->query($sql);

        //$conn->close();
        $student_payments = array();

        while ($row = $result->fetch_assoc()) {
            array_push($student_payments, $row);
        }
        return [$conn, $student_payments];


    }

    public function addFee(mysqli $conn, $enrolment_id, Request $request)
    {

        $sql = "INSERT INTO `fees` (`enrolment_id`, `fee_amount`, `is_paid`, `created_at`, `updated_at`) VALUES ('{$enrolment_id}', '{$request->fee}', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

        $result = $conn->query($sql);


        return $conn;


    }


}