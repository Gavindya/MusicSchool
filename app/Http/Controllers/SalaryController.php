<?php

namespace App\Http\Controllers;

use App\DAO\PaymentDAO;
use App\DAO\TeacherDAO;
use App\Domain\Teacher;
use Request;
use Session;

class SalaryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getPaymentsOfThisMonth()
    {
        if (date("d") === "28") {
            $msg = $this->generateSalary();
            Session::flash('msg', $msg);
        }
        $dbCon = new PaymentDAO();
        $payments = $dbCon->getUnpaidPaymentsOfThisMonth();
        $tot = $dbCon->totalPaid();
        return view('payRole', ['payments' => $payments, 'tot' => $tot, 'paymentWinType' => "ThisMonth"]);
    }

    public function generateSalary()
    {
        $teacherDAO = new TeacherDAO();
        $workHours = $teacherDAO->getWorkHours();

        $paymentsOfMonth = Teacher::generateMonthlySalary($workHours);

        $paymentDAO = new PaymentDAO();
        $paymentDAO->generatePayments($paymentsOfMonth);

        return "Salary Generated For this Month";
    }

    public function getAllPayments()
    {
        if (date("d") === "28") {
            $msg = $this->generateSalary();
            Session::flash('msg', $msg);
        }
        $dbCon = new PaymentDAO();
        $payments = $dbCon->getAllUnpaidPayments();
        $tot = $dbCon->totalPaid();
        return view('payRole', ['payments' => $payments, 'tot' => $tot, 'paymentWinType' => "All"]);
    }

    public function getSummary()
    {
        if (date("d") === "28") {
            $msg = $this->generateSalary();
            Session::flash('msg', $msg);
        }
        $dbCon = new PaymentDAO();
        $payments = $dbCon->getAllPayments();
        $tot = $dbCon->totalPaid();
        return view('SummaryOfPayments', ['payments' => $payments, 'tot' => $tot]);
    }

    public function getSummaryThisMonth()
    {
        if (date("d") === "28") {
            $msg = $this->generateSalary();
            Session::flash('msg', $msg);
        }
        $dbCon = new PaymentDAO();
        $payments = $dbCon->getAllPaymentsOfThisMonth();
        $tot = $dbCon->totalPaid();
        return view('SummaryOfPayments', ['payments' => $payments, 'tot' => $tot]);
    }

    public function payTeachers(Request $request)
    {
        if (isset($request->all()['selected'])) {
            $paymentsIdList = $request->all()['selected'];
            $paymentDao = new PaymentDAO();
            $paymentDao->setPaymentAsPaid($paymentsIdList);
            Session::flash('paid', "Successfully Paid Teachers");
            return redirect()->back();
        } else {
            Session::flash('error', "Teachers Not Selected");
            return redirect()->back();
        }
    }

    public function getPaymentsOfTeacher($id)
    {
        $dbCon = new PaymentDAO();
        $result = $dbCon->getPaymentsOfATeacher($id);
        return $result;
    }


}
