<?php

namespace App\Http\Controllers;

use App\DAO\PaymentDAO;
use App\DAO\TeacherDAO;
use App\Domain\Payrole;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class SalaryController extends Controller
{
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
            $paidMsg = $paymentDao->pay($paymentsIdList);
            if($paidMsg==="1"){
                Session::flash('paidMsg', "Successfully paid the teacher");
                Session::flash('alertType', "alert-success");
            }else{
                Session::flash('paidMsg', "Error Occurred");
                Session::flash('alertType', "alert-danger");
            }
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
    
    public function setPaymentPerHour(Request $request){
        $payment=$request->paymentPerHour;
        $intPayment = (int)$payment;
        if($intPayment>10000){
            echo dd("too large");
        }else{
            $paymentDAO = new PaymentDAO();
            $paymentDAO->changePayementPerHour($intPayment);
        }

    }

    public function setPaymentDate(Request $request){
        $payDay=$request->paymentDate;
        $intPayDay = (int)$payDay;
        if($intPayDay>30){
            echo dd("too large");
        }else{
            $paymentDAO = new PaymentDAO();
            $paymentDAO->changePayementDate($intPayDay);
        }
    }

    public function generateSalary()
    {
        $teacherDAO = new TeacherDAO();
        $workHours = $teacherDAO->getWorkHours();

        $genSalary = new Payrole();
        $paymentsOfMonth = $genSalary->generateMonthlySalary($workHours);

        $paymentDAO = new PaymentDAO();
        $paymentDAO->generatePayments($paymentsOfMonth);

        return "Salary Generated For this Month";
    }


}