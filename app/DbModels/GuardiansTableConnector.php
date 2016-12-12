<?php
/**
 * Created by PhpStorm.
 * User: Dileka
 * Date: 12/8/2016
 * Time: 6:13 PM
 */

namespace app\DbModels;

use mysqli;
use Symfony\Component\HttpFoundation\Request;

class GuardiansTableConnector
{

    public function getName(mysqli $conn)
    {
        // $conn = DBConnection::openConnection();
        $sql = "SELECT guardians.name FROM guardians";
        $result = $conn->query($sql);
        //$conn->close();
        $guardians = array();
        while ($row = $result->fetch_assoc()) {
            array_push($guardians, $row['name']);
        }
        return [$conn, $guardians];


    }

    public function storeGuardian(mysqli $conn, Request $request)
    {
        //$conn = DBConnection::openConnection();
      
        $sql = "INSERT INTO `guardians` (`id`, `name`, `telephone`, `created_at`, `updated_at`) VALUES (NULL, '$request->guardian_name', '$request->guardian_phone', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";


        $result = $conn->query($sql);
        //$conn->close();
        return $conn;


    }

    public function getGuardians(mysqli $conn)
    {
        //$conn = DBConnection::openConnection();
        $sql = "SELECT * FROM guardians";
        $result = $conn->query($sql);
        // $conn->close();
        $students = array();

        while ($row = $result->fetch_assoc()) {

            array_push($students, $row);
        }
        return [$conn, $students];

    }


}