<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:07 AM
 */

namespace App;


use DB;
use Illuminate\Contracts\Auth\Authenticatable;

class UserDAO
{
    public function addUser(User $user): bool
    {
        return DB::insert("INSERT INTO `users` (name, username, password, role) VALUES (:name, :username, :password, :role)", [
            'name' => $user->getAuthIdentifierName(),
            'username' => $user->getAuthIdentifier(),
            'password' => $user->getAuthPassword(),
            'role' => $user->getRole()
        ]);
    }

    public function getUserById($identifier): User
    {
        $object = DB::selectOne("SELECT * FROM users WHERE username = :username", [
            'username' => $identifier
        ]);

        $user = new User();
        if (!isset($user)) {
            $user->name = $object->name;
            $user->username = $object->username;
            $user->password = $object->password;
            $user->remember_token = $object->remember_token;
            $user->role = $object->role;
        }
        return $user;
    }

    public function getUserByCredentials($username, $password): User
    {
        $object = DB::selectOne("SELECT * FROM users WHERE username = :username AND password = :password", [
            'username' => $username,
            'password' => $password
        ]);

        $user = new User();
        if (!isset($user)) {
            $user->name = $object->name;
            $user->username = $object->username;
            $user->password = $object->password;
            $user->remember_token = $object->remember_token;
            $user->role = $object->role;
        }
        return $user;
    }

    public function getUserByToken($identifier, $token): User
    {
        $object = DB::selectOne("SELECT * FROM users WHERE username = :username AND remember_token = :remember_token", [
            'username' => $identifier,
            'remember_token' => $token
        ]);

        $user = new User();
        if (!isset($user)) {
            $user->name = $object->name;
            $user->username = $object->username;
            $user->password = $object->password;
            $user->remember_token = $object->remember_token;
            $user->role = $object->role;
        }
        return $user;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        return DB::update("UPDATE users SET remember_token = :remember_token WHERE username = :username", [
            'remember_token' => $token,
            'username' => $user->getAuthIdentifier(),
        ]);
    }
}