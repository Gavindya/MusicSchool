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

    public function generateMonthlySalary($workingHoursArray,$payPerHour)
    {
        $paymentperHour = $payPerHour;
        $paymentsArr = array();
        foreach ($workingHoursArray as $t) {
            $t['tot'] = (integer)($t['tot'] * $paymentperHour);
            $element = array();
            $element['teacher_id'] = $t['teacher_id'];
            $element['tot'] = $t['tot'];
            array_push($paymentsArr, $element);
        }
        return $paymentsArr;
    }

}