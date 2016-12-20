<?php
namespace App\Providers;

use App\User;
use App\UserDAO;
use Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class AuthUserProvider implements UserProvider
{

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $userDAO = new UserDAO();
        return $userDAO->getUserById($identifier);
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed $identifier
     * @param  string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        $userDAO = new UserDAO();
        dd($identifier, $token);
        return $userDAO->getUserByToken($identifier, $token);
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  string $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        $userDAO = new UserDAO();
        $userDAO->updateRememberToken($user, $token);
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $userDAO = new UserDAO();
        $result = $userDAO->getUserById($credentials['username']);
        $user = new User();
        $user->username = $result->username;
        $user->password = $result->password;
        $user->remember_token = $result->remember_token;
        $user->role = $result->role;
        return $user;
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        if (array_key_exists('remember_token', $credentials)) {
            if ($credentials['remember_token'] != $user->getRememberToken()) return false;
        }
        return $credentials['username'] == $user->getAuthIdentifier() &&
            Hash::check($credentials['password'], $user->getAuthPassword());
    }
}