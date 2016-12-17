<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:11 AM
 */

namespace App\Domain;


class Student extends BaseModel
{
    public $student_id;
    public $student_name;
    public $student_address;
    public $student_telephone;
    public $student_joindate;
}