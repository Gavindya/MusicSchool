<?php
/**
 * Created by PhpStorm.
 * User: Dileka
 * Date: 12/11/2016
 * Time: 9:36 AM
 */

namespace app\DbModels;


use App\DAO\ConnectionManager;
use mysqli;

class ClassDAO
{

    public function getClassDetails(mysqli $conn)
    {
        $conn = ConnectionManager::openConnection();
        $sql = "SELECT `id`, `teacher_id`, `instrument_id`,`charges` FROM `courses`";
        $result = $conn->query($sql);

        //$conn->close();
        $class_details = array();

        while ($row = $result->fetch_assoc()) {
            array_push($class_details, $row);
        }
        return [$conn, $class_details];

    }


}