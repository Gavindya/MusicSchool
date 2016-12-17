<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 2:04 AM
 */

namespace App\Domain;

class StudentAssignment extends BaseModel
{
    public $assignment_id;
    public $course_id;
    public $title;
    public $marks;
}