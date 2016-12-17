<?php
/**
 * Created by PhpStorm.
 * User: Dileka
 * Date: 12/11/2016
 * Time: 9:36 AM
 */

namespace app\DbModels;


use App\DbConnection\DBConnection;
use mysqli;

class ClassTableConnector
{

    public function getClassDetails(mysqli $conn, $class_id)
    {
        $conn = DBConnection::openConnection();
        $sql = "SELECT `id`, `teacher_id`, `instrument_id` FROM `clas` WHERE `id`=$class_id";
        $result = $conn->query($sql);

        //$conn->close();
        $class_details = array();

        while ($row = $result->fetch_assoc()) {
            array_push($class_details, $row);
        }
        return [$conn, $class_details];

    }


}