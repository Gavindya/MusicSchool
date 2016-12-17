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

    public function checkUser($index): array
    {
        $conn = ConnectionManager::getConnection();
        $sql = "SELECT `password` FROM `users` WHERE `id`={$index}";
        return $conn->getPdo()->query($sql)->fetchAll();
    }
}