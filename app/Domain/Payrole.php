<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:11 AM
 */

namespace App\Domain;


class Payrole extends BaseModel
{
    public $payment_id;
    public $teacher_id;
    public $amount;
    public $generated_date;
    public $paid_date;
}