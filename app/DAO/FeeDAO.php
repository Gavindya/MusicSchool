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
        $conn = ConnectionManager::getConnection();
        $sql = "SELECT * FROM fees WHERE enrolment_id = :enrolment_id";
        $statement = $conn->statement($sql, ['enrolment_id' => $enrolment_id]);
        return $conn->getPdo()->query($statement)->fetchAll();
    }
}