<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 12:04 AM
 */

namespace App\Domain;


class Timeslot extends BaseModel
{
    public $timeslot_id;
    public $start_time;
    public $end_time;

    /**
     * Timeslot constructor.
     * @param $start_time
     * @param $end_time
     */
    public function __construct($start_time, $end_time)
    {
        parent::__construct();
        $this->start_time = $start_time;
        $this->end_time = $end_time;
    }

}