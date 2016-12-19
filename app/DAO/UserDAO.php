<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:07 AM
 */

namespace App;


use App\DAO\ConnectionManager;

class UserDAO
{
    public function addUser(User $user)
    {
        $conn = ConnectionManager::getPDO();
        $sql = "INSERT INTO `users` (name, email, password) VALUES (:name, :email, :password)";
        $statement = $conn->prepare($sql);
        return $statement->execute([
            ':name' => $user->name,
            ':email' => $user->email,
            ':password' => $user->password
        ]);
    }

    public function checkUser($email, $password)
    {
        $conn = ConnectionManager::getPDO();
        $sql = "SELECT `password` FROM `users` WHERE email = :email AND password = :password";
        $statement = $conn->prepare($sql);
        $statement->execute([':email' => $email, ':password' => $password]);
        return $statement->fetch();
    }
}