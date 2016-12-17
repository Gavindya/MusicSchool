<?php
//namespace App\DbConnection;
//
//class PaymentDAO
//{
//    public function getAllPayments()
//    {
//        $dbCon = new DBConnection();
//        $conn = $dbCon->openPDO();
//        $sql = "SELECT * FROM payrole NATURAL JOIN teachers WHERE payrole.paid_date IS NULL";
//        $statement = $conn->prepare($sql);
//        $statement->execute();
//        return $statement->fetchAll();
//    }
//
//    public function getPaymentsOfThisMonth()
//    {
//        $dbCon = new DBConnection();
//        $conn = $dbCon->openPDO();
//        $month = date("m");
//        $time = strtotime(date("y-m-d"));
//        $year = date("Y", $time);
//        $resultPeriod = $year . '-' . $month . '%';
//        $sql = "SELECT * FROM payrole NATURAL JOIN teachers WHERE generated_date LIKE :monthOfPay AND payrole.paid_date IS NULL";
//        $statement = $conn->prepare($sql);
//        $statement->bindValue(":monthOfPay", $resultPeriod);
//        $statement->execute();
//        return $statement->fetchAll();
//    }
//
//    public function getPayementsOfATeacher($id)
//    {
//        $dbCon = new DBConnection();
//        $conn = $dbCon->openPDO();
//        $sql = "SELECT * FROM `payrole` WHERE `teacher_id` = :id";
//        $q = $conn->prepare($sql);
//        $q->execute(array(':id' => "$id"));
//        $done = $q->fetchAll();
//        return $done;
//    }
//
//    public function pay($paymentsIdList)
//    {
//        $dbCon = new DBConnection();
//        $conn = $dbCon->openPDO();
//        $MonthDay = date("m-d");
//        $time = strtotime(date("y-m-d"));
//        $year = date("Y", $time);
//        $today = $year . '-' . $MonthDay;
//        for ($i = 0; $i < sizeof($paymentsIdList); $i++) {
//            $sql = "UPDATE `payrole` SET `paid_date`=:today WHERE `payment_id` = :id";
//            $statement = $conn->prepare($sql);
//            $statement->bindValue(":id", $paymentsIdList[$i]);
//            $statement->bindValue(":today", $today);
//            $statement->execute();
//        }
//        $total = $this->totalPaid($conn);
//        return $total;
//    }
//
//    public function totalPaid($conn)
//    {
//        $month = date("m");
//        $time = strtotime(date("y-m-d"));
//        $year = date("Y", $time);
//        $resultPeriod = $year . '-' . $month . '%';
//        $sql = "SELECT sum(amount) FROM `payrole` WHERE `paid_date` LIKE :today";
//        $statement = $conn->prepare($sql);
//        $statement->bindValue(":today", $resultPeriod);
//        $statement->execute();
//        $done = $statement->fetch();
//        $doubleValue = (double)$done[0];
//        $total = $doubleValue;
//        return $total;
//    }
//
//    public function recordPayments($paymentsGenerated)
//    {
//        $dbCon = new DBConnection();
//        $conn = $dbCon->openPDO();
//        $MonthDay = date("m-d");
//        $time = strtotime(date("y-m-d"));
//        $year = date("Y", $time);
//        $today = $year . '-' . $MonthDay;
//        for ($i = 0; $i < sizeof($paymentsGenerated); $i++) {
//            $sql = "INSERT INTO `payrole` (teacher_id,amount,generated_date) VALUES (:teacher_id,:amount,:genDate)";
//            $statement = $conn->prepare($sql);
//            $statement->bindValue(":teacher_id", $paymentsGenerated[$i]['teacher_id']);
//            $statement->bindValue(":amount", $paymentsGenerated[$i]['tot']);
//            $statement->bindValue(":genDate", $today);
//            $statement->execute();
//        }
//    }
//}