<?php
/**
 * Created by PhpStorm.
 * User: Dileka
 * Date: 12/12/2016
 * Time: 7:26 PM
 */

namespace app\DbModels;


use mysqli;
use Symfony\Component\HttpFoundation\Request;

class UsersTableConnector
{

    public function getNextUserId(mysqli $conn)
    {

        $sql = "SELECT COUNT ('id') FROM users";
        $result = $conn->query($sql);
        //$conn->close();
        $nextId = array();
        while ($row = $result->fetch_assoc()) {
            array_push($nextId, $row[0]);
        }
        return [$conn, $nextId+1];


    }

    public function storeUser(mysqli $conn, Request $request)
    {

           $sql="INSERT INTO `users` (`id`, `type`, `name`, `email`, `password`, `super_user`, `remember_token`, `created_at`, `updated_at`) VALUES (NULL, '{$request->type}', '{$request->name}', '{$request->email}', '{$request->password}', '0', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        //$sql = " INSERT INTO `users` (`id`, `type`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (NULL, '{$request->type}', '{$request->first_name}', '{$request->email}', '{$request->password}', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP); ";
        $result = $conn->query($sql);


        return $conn;
    }
    public function checkUser(mysqli $conn, Request $request){
        $sql="SELECT `password` FROM `users` WHERE `id`={$request->index}";
        $result = $conn->query($sql);
        $password = array();
        while ($row = $result->fetch_assoc()) {
            array_push($password, $row);
        }
        return [$conn, $password];
    }

}