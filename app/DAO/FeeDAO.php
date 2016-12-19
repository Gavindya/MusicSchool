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
    public function getFees($enrolment_id): array
    {
        $conn = ConnectionManager::getPDO();
        $sql = "SELECT * FROM fees WHERE enrolment_id = :enrolment_id";
        $statement = $conn->prepare($sql);
        $statement->execute([':enrolment_id' => $enrolment_id]);
        return $statement->fetchAll();
    }
}