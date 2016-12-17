<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:11 AM
 */

namespace App\Domain;


class WorkRecord extends BaseModel
{
    public $teacher_id;
    public $work_date;
    public $arrive_time;
    public $leave_time;
}