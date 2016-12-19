<?php
/**
 * Created by PhpStorm.
 * User: Dileka
 * Date: 12/15/2016
 * Time: 9:07 AM
 */

namespace app\DbModels;


use Illuminate\Http\Request;
use mysqli;

class FamilyTableConnector
{

    public function storeFamily(mysqli $conn, $student_id, $guardian_id, Request $request)
    {
        echo 'in database';
        echo $student_id;
        var_dump($student_id);
        $sql = "INSERT INTO `families` (`student_id`, `guardian_id`, `relationship`, `created_at`, `updated_at`) VALUES ('{$student_id}', '{$guardian_id}', '{$request->relationship}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

        $result = $conn->query($sql);
        //$conn->close();
        return $conn;


    }

}