<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:05 AM
 */

namespace App\DAO;


class FamilyDAO
{
    public function storeFamily(mysqli $conn, $student_id, $guardian_id, Request $request)
    {
      
        echo $student_id;
        var_dump($student_id);
        $sql = "INSERT INTO `families` (`student_id`, `guardian_id`, `relationship`, `created_at`, `updated_at`) VALUES ('{$student_id}', '{$guardian_id}', '{$request->relationship}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

        $result = $conn->query($sql);
        //$conn->close();
        return $conn;


    }


}