<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:08 AM
 */

namespace App\Domain;


class Enrolment extends BaseModel
{
    public $enrolment_id;
    public $student_id;
    public $course_id;
    public $is_active;
}