<?php

namespace App\Http\Controllers;

class SalaryController extends Controller
{
    public function getPayments()
    {
        return view('payRole');
    }

    public function getPaymentsOfTeacher($id)
    {
        $payments = array();
        array_push($payments, 1);
        array_push($payments, $id);
        array_push($payments, 40000);
        array_push($payments, "12-12-2016");
        return $payments;
    }
}
