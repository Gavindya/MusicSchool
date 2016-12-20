<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:07 AM
 */

namespace App\DAO;

use DB;
use Mockery\CountValidator\Exception;

class PaymentDAO
{
    public function getAllUnpaidPayments()
    {
        $payments = DB::select('SELECT * FROM payrole NATURAL JOIN teachers WHERE payrole.paid_date IS NULL');
        $payments = json_decode(json_encode($payments), TRUE);
        return $payments;
    }

    public function getAllPayments()
    {
        $payments = DB::select('SELECT * FROM payrole NATURAL JOIN teachers');
        $payments = json_decode(json_encode($payments), TRUE);
        return $payments;
    }

    public function getUnpaidPaymentsOfThisMonth()
    {
        $month = date("m");
        $time = strtotime(date("y-m-d"));
        $year = date("Y", $time);
        $resultPeriod = $year . '-' . $month . '%';
        $payments = DB::select('SELECT * FROM payrole NATURAL JOIN teachers WHERE generated_date LIKE :monthOfPay AND payrole.paid_date IS NULL',
            ['monthOfPay' => $resultPeriod]);
        $payments = json_decode(json_encode($payments), TRUE);
        return $payments;
    }

    public function getPaymentsOfThisMonth()
    {
        $month = date("m");
        $time = strtotime(date("y-m-d"));
        $year = date("Y", $time);
        $resultPeriod = $year . '-' . $month . '%';
        $payments = DB::select('SELECT * FROM payrole NATURAL JOIN teachers WHERE generated_date LIKE :monthOfPay',
            ['monthOfPay' => $resultPeriod]);
        $payments = json_decode(json_encode($payments), TRUE);
        return $payments;
    }

    public function getPayementsOfATeacher($id)
    {
        $payments = DB::select('SELECT * FROM `payrole` WHERE `teacher_id` = :id AND paid_date IS NOT NULL '
            , ['id' => $id]);
        $payments = json_decode(json_encode($payments), TRUE);
        return $payments;
    }

    public function pay($paymentsIdList)
    {
        $MonthDay = date("m-d");
        $time = strtotime(date("y-m-d"));
        $year = date("Y", $time);
        $today = $year . '-' . $MonthDay;
        DB::beginTransaction();
        try{
            for ($i = 0; $i < sizeof($paymentsIdList); $i++) {
                DB::update(
                    'UPDATE `payrole` SET `paid_date`=:today WHERE `payment_id` = :id', [
                    'id' => $paymentsIdList[$i],
                    'today' => $today
                ]);
            }
            
            DB::commit();
            return "1";
        }catch (Exception $ex){
            DB::rollBack();
            return "0";
        }
        
    }

    public function totalPaid()
    {
        $month = date("m");
        $time = strtotime(date("y-m-d"));
        $year = date("Y", $time);
        $resultPeriod = $year . '-' . $month . '%';
        $amount = DB::selectOne('SELECT sum(amount) FROM `payrole` WHERE `paid_date` LIKE :today', [
            'today' => $resultPeriod
        ]);
        $amount = json_decode(json_encode($amount), TRUE);
        $doubleValue = (double)$amount['sum(amount)'];
        $total = $doubleValue;
        return $total;
    }

    public function generatePayments($paymentsGenerated)
    {
        $MonthDay = date("m-d");
        $month = date("m");
        $time = strtotime(date("y-m-d"));
        $year = date("Y", $time);
        $today = $year . '-' . $MonthDay;
        $resultPeriod = $year . '-' . $month . '%';

        $res = array();

        for ($i = 0; $i < sizeof($paymentsGenerated); $i++) {
            $done = DB::selectOne('SELECT * FROM `payrole` WHERE `teacher_id` = :teacher_id AND generated_date LIKE :timePeriod', [
                'teacher_id' => $paymentsGenerated[$i]['teacher_id'],
                'timePeriod' => $resultPeriod
            ]);
            $done = json_decode(json_encode($done), TRUE);
            if ($done['teacher_id'] != null) {
                array_push($res, $done['teacher_id']);
            }
        }
        foreach ($paymentsGenerated as $p) {
            if (!in_array($p['teacher_id'], $res)) {
                DB::insert(
                    'INSERT INTO `payrole` (teacher_id,amount,generated_date) VALUES (:teacher_id,:amount,:genDate)', [
                    'teacher_id' => $p['teacher_id'],
                    'amount' => $p['tot'],
                    'genDate' => $today
                ]);
            }
        }
    }
    
    public function changePaymentPerHour($payment){

        $MonthDay = date("m-d");
        $time = strtotime(date("y-m-d"));
        $year = date("Y", $time);
        $today = $year . '-' . $MonthDay;

        try {
            DB::insert(
                'INSERT INTO `salaries` (hourly_amount, revision_date) VALUES (:amount,:today) ON DUPLICATE KEY UPDATE
                  hourly_amount = VALUES(hourly_amount);'
//                'INSERT INTO `salaries` VALUES (:amount,:today);'
            , [
                'today' => $today,
                'amount' => $payment
            ]);
            return "1";
        }catch(Exception $ex){
            return "0";
        }
//        echo dd("Not Implemented");
    }

    public function getHourlyPay(){
//        $month = date("m");
//        $time = strtotime(date("y-m-d"));
//        $year = date("Y", $time);
//        $resultPeriod = $year . '-' . $month . '%';

        $payment = DB::selectOne('SELECT * FROM salaries ORDER BY revision_date DESC LIMIT 1;');
        $payment = json_decode(json_encode($payment), TRUE);
        return $payment;

    }

}