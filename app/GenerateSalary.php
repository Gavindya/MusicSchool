<?php

namespace App;

class GenerateSalary
{
    public function generateMonthlySalary($workingHoursArray)
    {
        $paymentperHour = 2000;
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