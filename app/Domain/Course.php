<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 12:01 AM
 */

namespace App\Domain;


class Course extends BaseModel
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
    public function __construct($course_name, $instrument_id, $credits, $weekday, $timeslot_id, $charges, $teacher_id)
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

    /**
     * @return mixed
     */
    public function getCourseId()
    {
        return $this->course_id;
    }

    /**
     * @param mixed $course_id
     */
    public function setCourseId($course_id)
    {
        $this->course_id = $course_id;
    }

    /**
     * @return string
     */
    public function getCourseName(): string
    {
        return $this->course_name;
    }

    /**
     * @param string $course_name
     */
    public function setCourseName(string $course_name)
    {
        $this->course_name = $course_name;
    }

    /**
     * @return int
     */
    public function getInstrumentId(): int
    {
        return $this->instrument_id;
    }

    /**
     * @param int $instrument_id
     */
    public function setInstrumentId(int $instrument_id)
    {
        $this->instrument_id = $instrument_id;
    }

    /**
     * @return mixed
     */
    public function getInstrumentName()
    {
        return $this->instrument_name;
    }

    /**
     * @param mixed $instrument_name
     */
    public function setInstrumentName($instrument_name)
    {
        $this->instrument_name = $instrument_name;
    }

    /**
     * @return int
     */
    public function getCredits(): int
    {
        return $this->credits;
    }

    /**
     * @param int $credits
     */
    public function setCredits(int $credits)
    {
        $this->credits = $credits;
    }

    /**
     * @return string
     */
    public function getWeekday(): string
    {
        return $this->weekday;
    }

    /**
     * @param string $weekday
     */
    public function setWeekday(string $weekday)
    {
        $this->weekday = $weekday;
    }

    /**
     * @return int
     */
    public function getTimeslotId(): int
    {
        return $this->timeslot_id;
    }

    /**
     * @param int $timeslot_id
     */
    public function setTimeslotId(int $timeslot_id)
    {
        $this->timeslot_id = $timeslot_id;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * @param mixed $start_time
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * @param mixed $end_time
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;
    }

    /**
     * @return int
     */
    public function getCharges(): int
    {
        return $this->charges;
    }

    /**
     * @param int $charges
     */
    public function setCharges(int $charges)
    {
        $this->charges = $charges;
    }

    /**
     * @return int
     */
    public function getTeacherId(): int
    {
        return $this->teacher_id;
    }

    /**
     * @param int $teacher_id
     */
    public function setTeacherId(int $teacher_id)
    {
        $this->teacher_id = $teacher_id;
    }

    /**
     * @return mixed
     */
    public function getTeacherName()
    {
        return $this->teacher_name;
    }

    /**
     * @param mixed $teacher_name
     */
    public function setTeacherName($teacher_name)
    {
        $this->teacher_name = $teacher_name;
    }
}