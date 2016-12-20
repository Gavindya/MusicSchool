<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:05 AM
 */

namespace App\DAO;


class FeeDAO
{
    public function getFees($student_id)
    {
        $conn = ConnectionManager::getPDO();
        $sql = "SELECT * FROM fees WHERE enrolment_id IN (SELECT enrolment_id FROM 
                  enrolments WHERE student_id = :student_id);";
        $statement = $conn->prepare($sql);
        $statement->execute([':student_id' => $student_id]);
        return $statement->fetchAll();
    }
}