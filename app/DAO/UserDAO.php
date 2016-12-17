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
    public function addUser(User $user): bool
    {
        $conn = ConnectionManager::getConnection();
        $sql = "INSERT INTO `users` (name, email, password) VALUES ('{$user->name}', '{$user->email}', '{$user->password}')";
        return $conn->getPdo()->exec($sql);
    }

    public function checkUser($email, $password): array
    {
        $conn = ConnectionManager::getConnection();
        $sql = "SELECT `password` FROM `users` WHERE email = :email AND password = :password";
        $statement = $conn->statement($sql, ['email' => $email, 'password' => $password]);
        return $conn->getPdo()->query($statement)->fetchAll();
    }
}