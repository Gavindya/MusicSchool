<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:08 AM
 */

namespace App\Domain;


class Fee extends BaseModel
{
    public $enrolment_id;
    public $fee_date;
    public $fee_amount;
    public $is_paid;
}