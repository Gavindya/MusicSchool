<?php

namespace App\Http\Controllers;

use App\DbConnection\PaymentDAO;
use Symfony\Component\HttpFoundation\Request;

class SalaryController extends Controller
{
    public function getPayments()
    {
        $dbCon = new PaymentDAO();
        $result = $dbCon->getAllPayments();
        $payments = array();
        while ($row = $result->fetch_assoc()) {
            array_push($payments, $row);
        }
        return view('payRole', ['payments' => $payments]);
    }

    public function payTeachers(Request $request)
    {
        if (isset($request->all()['selected'])) {
            $idList = $request->all()['selected'];
//            foreach ($idList as $id){
//                echo $id;
//            }
            $paymentDao = new PaymentDAO();
            $paymentDao->pay($idList);
//            $this->getPayments();
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
