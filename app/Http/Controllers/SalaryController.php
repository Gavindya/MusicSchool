<?php

namespace App\Http\Controllers;

use App\DbConnection\PaymentDAO;
use Symfony\Component\HttpFoundation\Request;

class SalaryController extends Controller
{
    public function getPaymentsOfThisMonth()
    {
        $dbCon = new PaymentDAO();
        $payments = $dbCon->getPaymentsOfThisMonth();
        return view('payRole', ['payments' => $payments]);
    }

    public function getAllPayments()
    {
        $dbCon = new PaymentDAO();
        $payments = $dbCon->getAllPayments();
        return view('payRole', ['payments' => $payments]);
    }

    public function payTeachers(Request $request)
    {
        if (isset($request->all()['selected'])) {
            $paymentsIdList = $request->all()['selected'];
            $paymentDao = new PaymentDAO();
            $paymentDao->pay($paymentsIdList);
            return redirect()->back();
        } else {
            echo "Not selected any";
        }
    }

    public function getPaymentsOfTeacher($id)
    {
        $dbCon = new PaymentDAO();
        $result = $dbCon->getPayementsOfATeacher($id);
        return $result;
    }
}
