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

        $sql = "SELECT * FROM `users` ";
        $result = $conn->query($sql);
        $next_id = $result->num_rows;
        //$conn->close();

        return [$conn, $next_id + 1];


    }

    public function storeUser(mysqli $conn, Request $request)
    {
        // to prevent mysql injection
        // $conn->escape_string($request->name);


        //$sql="INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`)VALUES (NULL, '$request->name', '{$request->email}', '', '{$request->role}', '', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

        // $result = $conn->query($sql);
        $name = $request->all()['name'];
        $email = $request->all()['email'];
        $role = $request->all()['role'];


        $sql = "INSERT INTO `users` (`name`, `email`, `role`)
              VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $role);
        $stmt->execute();


        return $conn;
    }

    public function checkUser(mysqli $conn, Request $request)
    {


        $conn->escape_string($request->index);

        $sql = "SELECT `password` FROM `users` WHERE username={$request->index}";
        $result = $conn->query($sql);
        $row_cnt = $result->num_rows;
        if ($row_cnt == 0) {
            return [$conn, 0];
        }
        $password = array();
        while ($row = $result->fetch_assoc()) {
            array_push($password, $row);
        }

        return [$conn, $password];


        /* close result set */

    }

    public function getUsers(mysqli $conn)
    {
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        $users = array();

        while ($row = $result->fetch_assoc()) {

            array_push($users, $row);
        }
        return [$conn, $users];

    }


}