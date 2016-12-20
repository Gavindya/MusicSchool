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
        $hourlyPayment = $dbCon->getHourlyPay();
        $tot = $dbCon->totalPaid();
        return view('payRole', ['payments' => $payments, 'hourlyPayment' => $hourlyPayment['hourly_amount'],'tot' => $tot, 'paymentWinType' => "ThisMonth"]);
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
        $hourlyPayment = $dbCon->getHourlyPay();
        return view('payRole', ['payments' => $payments,
                                'hourlyPayment' => $hourlyPayment['hourly_amount'],
                                'tot' => $tot,
                                'paymentWinType' => "All"]);
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
            Session::flash('error', "Could Not Set Payment Per Hour");
            return redirect()->back();
        }else{
            $paymentDAO = new PaymentDAO();
            $msg=$paymentDAO->changePaymentPerHour($intPayment);
            if($msg==="1"){
                Session::flash('msg', "Changed Payment Per Hour");
                return redirect()->back();
            }else{
                Session::flash('msg', "A value has been already set");
                return redirect()->back();
            }
            
        }
    }
    
    public function generateSalary()
    {
        $teacherDAO = new TeacherDAO();
        $paymentDAO = new PaymentDAO();
        $genSalary = new Payrole();
        
        $workHours = $teacherDAO->getWorkHours();
        
        $hourlyPayment = $paymentDAO->getHourlyPay();
        $hourlyPayment=$hourlyPayment['hourly_amount'];
        
        $paymentsOfMonth = $genSalary->generateMonthlySalary($workHours,$hourlyPayment);
        
        
        $paymentDAO->generatePayments($paymentsOfMonth);

        
        
        return "Salary Generated For this Month";
    }


}