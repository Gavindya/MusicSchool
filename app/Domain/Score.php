<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:11 AM
 */

namespace App\Domain;


class Score extends BaseModel
{
    public $assignment_id;
    public $enrolment_id;
    public $score;
}