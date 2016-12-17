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
}