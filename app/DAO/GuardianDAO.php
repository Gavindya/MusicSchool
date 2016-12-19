<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:05 AM
 */

namespace App\DAO;


use App\Domain\Guardian;

class GuardianDAO
{
    public function getGuardianNames()
    {
        $conn = ConnectionManager::getPDO();
        $sql = "SELECT guardian_name FROM guardians";
        return $conn->query($sql)->fetchAll();
    }

    public function addGuardian(Guardian $guardian)
    {
        $conn = ConnectionManager::getPDO();
        $sql = "INSERT INTO guardians (guardian_name, guardian_telephone) VALUES (:guardian_name, :guardian_telephone)";
        $statement = $conn->prepare($sql);
        return $statement->execute([
            ':guardian_name' => $guardian->guardian_name,
            ':guardian_telephone' => $guardian->guardian_telephone
        ]);
    }

    public function getGuardians()
    {
        $conn = ConnectionManager::getPDO();
        $sql = "SELECT * FROM guardians";
        return $conn->query($sql)->fetchAll();
    }
}