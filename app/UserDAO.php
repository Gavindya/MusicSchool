<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:07 AM
 */

namespace App;


use App\VO\VOBase;

class UserDAO extends VOBase
{
    public $username;
    public $password;
    public $role;
}