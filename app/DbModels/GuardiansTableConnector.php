<?php
/**
 * Created by PhpStorm.
 * User: Dileka
 * Date: 12/8/2016
 * Time: 6:13 PM
 */

namespace app\DbModels;

use App\DbConnection\DBConnection;
use Symfony\Component\HttpFoundation\Request;

class GuardiansTableConnector
{

    public function getName()
    {
        $conn = DBConnection::openConnection();
        $sql = "SELECT guardians.name FROM guardians";
        $result = $conn->query($sql);
        $conn->close();
        $guardians = array();
        while ($row = $result->fetch_assoc()) {
            array_push($guardians, $row['name']);
        }
        return $guardians;


    }

    public function storeGuardian(Request $request)
    {
        $conn = DBConnection::openConnection();
        $sql = "INSERT INTO `guardians` (`id`, `name`, `telephone`, `created_at`, `updated_at`) VALUES (NULL, '$request->guardian_name', '$request->guardian_phone', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";


        $result = $conn->query($sql);
        $conn->close();
        return $result;


    }

    public function getGuardians()
    {
        $conn = DBConnection::openConnection();
        $sql = "SELECT * FROM guardians";
        $result = $conn->query($sql);
        $conn->close();
        $students = array();

        while ($row = $result->fetch_assoc()) {

            array_push($students, $row);
        }
        return $students;

    }


}