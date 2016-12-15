<?php
namespace App\DbConnection;

class PaymentDAO
{
    public function getAllPayments()
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $sql = "SELECT * FROM payrole NATURAL JOIN teachers WHERE payrole.paid_date IS NULL";
        $statement = $conn->prepare($sql);
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
        $sql = "SELECT * FROM payrole NATURAL JOIN teachers WHERE generated_date LIKE :monthOfPay AND payrole.paid_date IS NULL";
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
        $month = date("m");
        $time = strtotime(date("y-m-d"));
        $year = date("Y", $time);
        $resultPeriod = $year . '-' . $month . '%';
        $today = $year . '-' . $MonthDay;
        echo $today;
        echo $resultPeriod;

        for ($i = 0; $i < sizeof($paymentsIdList); $i++) {
            $sql = "UPDATE `payrole` SET `paid_date`=:today WHERE `payment_id` = :id";
            $statement = $conn->prepare($sql);
            $statement->bindValue(":id", $paymentsIdList[$i]);
            $statement->bindValue(":today", $today);
            $statement->execute();
        }
    }

}