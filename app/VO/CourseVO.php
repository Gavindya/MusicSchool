<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 12:01 AM
 */

namespace App\VO;


class CourseVO extends VOBase
{
    public $course_id;
    public $instrument_id;
    public $instrument_name;
    public $weekday;
    public $timeslot_id;
    public $start_time;
    public $end_time;
    public $charges;
    public $teacher_id;
    public $teacher_name;
}