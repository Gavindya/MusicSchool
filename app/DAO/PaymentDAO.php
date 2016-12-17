<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:07 AM
 */

namespace App\DAO;

class PaymentDAO
{
    public function getAllUnpaidPayments(): array
    {
        $conn = ConnectionManager::getConnection();
        $sql = "SELECT * FROM payrole NATURAL JOIN teachers WHERE payrole.paid_date IS NULL";
        return $conn->getPdo()->query($sql)->fetchAll();
    }

    public function getAllPayments(): array
    {
        $conn = ConnectionManager::getConnection();
        $sql = "SELECT * FROM payrole NATURAL JOIN teachers";
        return $conn->getPdo()->query($sql)->fetchAll();
    }

    public function getUnpaidPaymentsOfThisMonth(): array
    {
        $conn = ConnectionManager::getConnection();
        $resultPeriod = $this->GetYearMonthString() . '%';

        $sql = "SELECT * FROM payrole NATURAL JOIN teachers WHERE generated_date LIKE :monthOfPay AND paid_date IS NULL";

        $statement = $conn->getPdo()->prepare($sql);
        $statement->bindValue(":monthOfPay", $resultPeriod);
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * @return string
     */
    public function GetYearMonthString(): string
    {
        $month = date("m");
        $time = strtotime(date("y-m-d"));
        $year = date("Y", $time);
        $resultPeriod = $year . '-' . $month;
        return $resultPeriod;
    }

    public function getAllPaymentsOfThisMonth(): array
    {
        $conn = ConnectionManager::getConnection();
        $resultPeriod = $this->GetYearMonthString() . '%';
        $sql = "SELECT * FROM payrole NATURAL JOIN teachers WHERE generated_date LIKE :monthOfPay";

        $statement = $conn->getPdo()->prepare($sql);
        $statement->bindValue(":monthOfPay", $resultPeriod);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getPaymentsOfATeacher($teacher_id): array
    {
        $conn = ConnectionManager::getConnection();
        $sql = "SELECT * FROM `payrole` WHERE `teacher_id` = :teacher_id";

        $statement = $conn->getPdo()->prepare($sql);
        $statement->execute(['teacher_id' => "$teacher_id"]);
        $done = $statement->fetchAll();
        return $done;
    }

    public function setPaymentAsPaid($paymentsIdList): bool
    {
        $conn = ConnectionManager::getConnection();

        $conn->beginTransaction();
        for ($i = 0; $i < sizeof($paymentsIdList); $i++) {
            $sql = "UPDATE payrole SET paid_date = CURRENT_DATE() WHERE payment_id = :payment_id";
            $statement = $conn->getPdo()->prepare($sql);
            $statement->bindValue("payment_id", $paymentsIdList[$i]);
            $statement->execute();
        }
        $conn->commit();
        return true;
    }

    public function totalPaid(): double
    {
        $conn = ConnectionManager::getConnection();
        $resultPeriod = $this->GetYearMonthString() . '%';

        $sql = "SELECT sum(amount) FROM `payrole` WHERE `paid_date` LIKE :today";
        $statement = $conn->getPdo()->prepare($sql);
        $statement->bindValue("today", $resultPeriod);

        return (double)$statement->fetchObject()->amount;
    }

    public function generatePayments($paymentsGenerated): bool
    {
        $conn = ConnectionManager::getConnection();
        $resultPeriod = $this->GetYearMonthString() . '%';
        $res = array();

        for ($i = 0; $i < sizeof($paymentsGenerated); $i++) {
            $sql = "SELECT * FROM `payrole` WHERE `teacher_id` = :teacher_id AND generated_date LIKE :timePeriod";

            $statement = $conn->getPdo()->prepare($sql);
            $statement->bindValue(":teacher_id", $paymentsGenerated[$i]['teacher_id']);
            $statement->bindValue(":timePeriod", $resultPeriod);
            $statement->execute();

            $done = $statement->fetch();
            if ($done['teacher_id'] != null) {
                array_push($res, $done['teacher_id']);
            }
        }

        $conn->beginTransaction();
        foreach ($paymentsGenerated as $payment) {
            if (!in_array($payment['teacher_id'], $res)) {
                $sql = "INSERT INTO `payrole` (teacher_id,amount,generated_date) VALUES (:teacher_id,:amount, CURRENT_DATE())";

                $statement = $conn->getPdo()->prepare($sql);
                $statement->bindValue(":teacher_id", $payment['teacher_id']);
                $statement->bindValue(":amount", $payment['tot']);
                $statement->execute();
            }
        }
        $conn->commit();
        return true;
    }
}