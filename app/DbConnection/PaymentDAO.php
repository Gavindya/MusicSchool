<?php
namespace App\DbConnection;

class PaymentDAO
{
    public function getAllPayments()
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openConnection();
        $sql = "SELECT * FROM payrole NATURAL JOIN teachers";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function getPaymentsOfThisMonth()
    {

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

    public function pay($idList)
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $MonthDay = date("m-d");
        $month = date("m");
        $time = strtotime(date("y-m-d"));
        $year = date("Y", $time);
        $resultPeriod = $year . '-' . $month . '%';
        $today = $year . '-' . $MonthDay;
        echo $resultPeriod;
//        $sql = "UPDATE `payrole` SET `paid_date` = :today WHERE `teacher_id` = :id AND `generated_date` LIKE :monthOfPay";
//            $statement = $conn->prepare($sql);
//            $statement->bindValue(":id", 1);
//            $statement->bindValue(":today ", $today);
//            $statement->bindValue(":monthOfPay", $resultPeriod);
//            $statement->execute();

//        foreach ($idList as $id){
//            $sql = "UPDATE `payrole` SET `paid_date` = :today WHERE `teacher_id` = :id AND `generated_date` LIKE :monthOfPay";
//            $statement = $conn->prepare($sql);
//            $statement->bindValue(":id", $id);
//            $statement->bindValue(":today ", $today);
//            $statement->bindValue(":monthOfPay", $resultPeriod);
//            $statement->execute();
//        }
    }

}