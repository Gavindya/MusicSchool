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
    public function addUser(User $user)
    {
        return DB::insert("INSERT INTO `users` (username, password, role) VALUES (:username, :password, :role)", [
            'username' => $user->getAuthIdentifier(),
            'password' => $user->getAuthPassword(),
            'role' => $user->getRole()
        ]);
    }

    public function getUserById($identifier)

    {
        $object = DB::selectOne("SELECT * FROM users WHERE username = :username", [
            'username' => $identifier
        ]);
        $user = new User();
        if (isset($object)) {
            $user->username = $object->username;
            $user->password = $object->password;
            $user->remember_token = $object->remember_token;
            $user->role = $object->role;
        }
        return $user;
    }

    public function getUserByCredentials($username, $password)
    {
        $object = DB::selectOne("SELECT * FROM users WHERE username = :username AND password = :password", [
            'username' => $username,
            'password' => $password
        ]);

        $user = new User();
        if (isset($object)) {
            $user->username = $object->username;
            $user->password = $object->password;
            $user->remember_token = $object->remember_token;
            $user->role = $object->role;
        }
        return $user;
    }

    public function getUserByToken($identifier, $token)
    {
        $object = DB::selectOne("SELECT * FROM users WHERE username = :username AND remember_token = :remember_token", [
            'username' => $identifier,
            'remember_token' => $token
        ]);

        $user = new User();
        if (isset($object)) {
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