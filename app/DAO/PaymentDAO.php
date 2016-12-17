<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:07 AM
 */

namespace App\DAO;

use PDO;

class PaymentDAO
{
    public function getAllUnpaidPayments()
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $sql = "SELECT * FROM payrole NATURAL JOIN teachers WHERE payrole.paid_date IS NULL";
        $statement = $conn->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    
    public function getAllPayments()
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $sql = "SELECT * FROM payrole NATURAL JOIN teachers";
        $statement = $conn->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getUnpaidPaymentsOfThisMonth()
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $month = date("m");
        $time = strtotime(date("y-m-d"));
        $year = date("Y", $time);
        $resultPeriod = $year . '-' . $month . '%';
        $sql = "SELECT * FROM payrole NATURAL JOIN teachers WHERE generated_date LIKE :monthOfPay AND payrole.paid_date IS NULL";
        $statement = $conn->prepare($sql);
        $statement->bindValue(":monthOfPay", $resultPeriod);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function getPaymentsOfThisMonth()
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $month = date("m");
        $time = strtotime(date("y-m-d"));
        $year = date("Y", $time);
        $resultPeriod = $year . '-' . $month . '%';
        $sql = "SELECT * FROM payrole NATURAL JOIN teachers WHERE generated_date LIKE :monthOfPay";
        $statement = $conn->prepare($sql);
        $statement->bindValue(":monthOfPay", $resultPeriod);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getPayementsOfATeacher($id)
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $sql = "SELECT * FROM `payrole` WHERE `teacher_id` = :id";
        $q = $conn->prepare($sql);
        $q->execute(array(':id' => "$id"));
        $done = $q->fetchAll();
        return $done;
    }

    public function pay($paymentsIdList)
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $MonthDay = date("m-d");
        $time = strtotime(date("y-m-d"));
        $year = date("Y", $time);
        $today = $year . '-' . $MonthDay;
        for ($i = 0; $i < sizeof($paymentsIdList); $i++) {
            $sql = "UPDATE `payrole` SET `paid_date`=:today WHERE `payment_id` = :id";
            $statement = $conn->prepare($sql);
            $statement->bindValue(":id", $paymentsIdList[$i]);
            $statement->bindValue(":today", $today);
            $statement->execute();
        }
    }

    public function totalPaid()
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $month = date("m");
        $time = strtotime(date("y-m-d"));
        $year = date("Y", $time);
        $resultPeriod = $year . '-' . $month . '%';
        $sql = "SELECT sum(amount) FROM `payrole` WHERE `paid_date` LIKE :today";
        $statement = $conn->prepare($sql);
        $statement->bindValue(":today", $resultPeriod);
        $statement->execute();
        $done = $statement->fetch();
        $doubleValue = (double)$done[0];
        $total = $doubleValue;
        return $total;
    }

    public function generatePayments($paymentsGenerated)
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $MonthDay = date("m-d");
        $month = date("m");
        $time = strtotime(date("y-m-d"));
        $year = date("Y", $time);
        $today = $year . '-' . $MonthDay;
        $resultPeriod = $year . '-' . $month . '%';

        $res = array();


        for ($i = 0; $i < sizeof($paymentsGenerated); $i++) {
            $sql = "SELECT * FROM `payrole` WHERE `teacher_id` = :teacher_id AND generated_date LIKE :timePeriod";
            $statement = $conn->prepare($sql);
            $statement->bindValue(":teacher_id", $paymentsGenerated[$i]['teacher_id']);
            $statement->bindValue(":timePeriod", $resultPeriod);
            $statement->execute();
            $done = $statement->fetch();
            if($done['teacher_id']!=null){
                array_push($res,$done['teacher_id']);
            }
        }
        foreach ($paymentsGenerated as $p){
            if(!in_array($p['teacher_id'],$res)){
                $sql = "INSERT INTO `payrole` (teacher_id,amount,generated_date) VALUES (:teacher_id,:amount,:genDate)";
                $statement = $conn->prepare($sql);
                $statement->bindValue(":teacher_id", $p['teacher_id']);
                $statement->bindValue(":amount", $p['tot']);
                $statement->bindValue(":genDate", $today);
                $statement->execute();
            }
        }
    }
}