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
    public $course_name;
    public $instrument_id;
    public $instrument_name;
    public $credits;
    public $weekday;
    public $timeslot_id;
    public $start_time;
    public $end_time;
    public $charges;
    public $teacher_id;
    public $teacher_name;

    /**
     * CourseVO constructor.
     * @param string $course_name
     * @param int $instrument_id
     * @param int $credits
     * @param string $weekday
     * @param int $timeslot_id
     * @param int $charges
     * @param int $teacher_id
     * @internal param $course_id
     */
    public function __construct(string $course_name, int $instrument_id, int $credits, string $weekday, int $timeslot_id, int $charges, int $teacher_id)
    {
        parent::__construct();
        $this->course_name = $course_name;
        $this->instrument_id = $instrument_id;
        $this->credits = $credits;
        $this->weekday = $weekday;
        $this->timeslot_id = $timeslot_id;
        $this->charges = $charges;
        $this->teacher_id = $teacher_id;
    }
}