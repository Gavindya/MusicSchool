<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:07 AM
 */

namespace App\Domain;

class AttendanceRecord extends BaseModel
{
    public $enrolment_id;
    public $date;
    public $student_status;
    public $student_attendance;
    public $student_id;
    public $student_name;
    public $course_name;
}