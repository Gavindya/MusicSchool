<?php

namespace App\Http\Controllers;

use App\DbConnection\PaymentDAO;
use App\DbConnection\TeacherDAO;
use App\GenerateSalary;
use Symfony\Component\HttpFoundation\Request;

class SalaryController extends Controller
{
    public function getPaymentsOfThisMonth($tot = null)
    {
        $dbCon = new PaymentDAO();
        $payments = $dbCon->getPaymentsOfThisMonth();
        return view('payRole', ['payments' => $payments, 'tot' => $tot, 'paymentWinType' => "ThisMonth"]);
    }

    public function getAllPayments($tot = null)
    {
        $dbCon = new PaymentDAO();
        $payments = $dbCon->getAllPayments();
        return view('payRole', ['payments' => $payments, 'tot' => $tot, 'paymentWinType' => "All"]);
    }

    public function payTeachers(Request $request)
    {

        if (isset($request->all()['selected'])) {
            $paymentsIdList = $request->all()['selected'];
            $paymentDao = new PaymentDAO();
            $totalPayment = $paymentDao->pay($paymentsIdList);
            if (($request->paymentWindow) === "ThisMonth") {
                $dbCon = new PaymentDAO();
                $payments = $dbCon->getPaymentsOfThisMonth();
                return view('payRole', ['payments' => $payments, 'tot' => $totalPayment, 'paymentWinType' => "ThisMonth"]);
            } else {
                $dbCon = new PaymentDAO();
                $payments = $dbCon->getAllPayments();
                return view('payRole', ['payments' => $payments, 'tot' => $totalPayment, 'paymentWinType' => "All"]);
            }

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

    public function generateSalary()
    {
        $teacherDAO = new TeacherDAO();
        $workHours = $teacherDAO->getWorkHours();

        $genSalary = new GenerateSalary();
        $paymentsOfMonth = $genSalary->generateMonthlySalary($workHours);

        $paymentDAO = new PaymentDAO();
        $paymentDAO->recordPayments($paymentsOfMonth);
    }
}
