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
}