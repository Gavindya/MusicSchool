<?php

namespace App\Http\Controllers;

use App\DAO\PaymentDAO;
use App\DAO\TeacherDAO;
use App\GenerateSalary;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

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
        if(date("d")==="28"){
            $msg = $this->generateSalary();
            Session::flash('msg', $msg);
        }
        $dbCon = new PaymentDAO();
        $payments = $dbCon->getUnpaidPaymentsOfThisMonth();
        $tot = $dbCon->totalPaid();
        return view('payRole', ['payments' => $payments, 'tot' => $tot, 'paymentWinType' => "ThisMonth"]);
    }

    public function getAllPayments()
    {
        if(date("d")==="28") {
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
        if(date("d")==="28") {
            $msg = $this->generateSalary();
            Session::flash('msg', $msg);
        }
        $dbCon = new PaymentDAO();
        $payments = $dbCon->getAllPayments();
        $tot = $dbCon->totalPaid();
        return view('SummaryOfPayments', ['payments' => $payments,'tot' => $tot]);
    }
    public function getSummaryThisMonth()
    {
        if(date("d")==="28") {
            $msg = $this->generateSalary();
            Session::flash('msg', $msg);
        }
        $dbCon = new PaymentDAO();
        $payments = $dbCon->getPaymentsOfThisMonth();
        $tot = $dbCon->totalPaid();
        return view('SummaryOfPayments', ['payments' => $payments,'tot' => $tot]);
    }
    
    public function payTeachers(Request $request)
    {
        if (isset($request->all()['selected'])) {
            $paymentsIdList = $request->all()['selected'];
            $paymentDao = new PaymentDAO();
            $paymentDao->pay($paymentsIdList);        
            Session::flash('paid', "Successfully Paid Teachers");
            return redirect()->back();
        }
        else {
            Session::flash('error', "Teachers Not Selected");
            return redirect()->back();
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
        $paymentDAO->generatePayments($paymentsOfMonth);

        return "Salary Generated For this Month";
    }

    
}
