<?php
namespace App\DbConnection;

use App\teacher;

class TeacherDAO
{
    public function getName()
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openConnection();
        $sql = "SELECT teachers.name FROM teachers";
        $result = $conn->query($sql);
        $conn->close();
        return $result;

    }

    public function getTeachers()
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openConnection();
        $sql = "SELECT * FROM teachers";
        $result = $conn->query($sql);
        $conn->close();
        return $result;

    }

    public function getATeacher($id)
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $sql = "SELECT * FROM `teachers` WHERE `id` = :id";
        $q = $conn->prepare($sql);
        $q->execute(array(':id' => "$id"));
        $done = $q->fetch();  //returns an array $done[0]=id and $done[1]=name
        return $done;
    }

    public function addNewTeacher(teacher $teacher)
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openConnection();
        $nameOfT = $teacher->getName();
        echo $nameOfT;
        $sql = "INSERT INTO `teachers` (`id`, `name`, `created_at`, `updated_at`) VALUES (NULL, '{$nameOfT}', NULL, NULL)";
        $conn->query($sql);
        $conn->close();
    }

    public function updateTeacher($mobile, $address, $id)
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $sql = "UPDATE `teachers` SET `mobile` = :mobile,
                                      `address` = :address
                                      WHERE `id` = :id";
        $statement = $conn->prepare($sql);
//        $statement->execute(array(":mobile"=> "$mobile",":address"=> "$address",":telephone"=>"$telephone"));
        $statement->bindValue(":mobile", $mobile);
        $statement->bindValue(":address", $address);
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

    public function recordAttendence($id, $arrive, $depart)
    {
        $today = date("y-m-d");
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $sql = "INSERT INTO `teachers` (`id`, `date`, `arrive`, `depart`) VALUES (:id,:today,:arrive,:depart)";
        $statement = $conn->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->bindValue(":today", $today);
        $statement->bindValue(":arrive", $arrive);
        $statement->bindValue(":depart", $depart);
        $statement->execute();

    }

    public function getAttendence($id)
    {
        $today = date("y-m-d");
        $dbcon = new DBConnection();
        $conn = $dbcon->openPDO();
        $sql = "SELECT * FROM `teachers` WHERE `date`=:today AND `id`=:id";
        $statement = $conn->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->bindValue(":today", $today);
        $statement->execute();
        $result = $statement->fetch();  //returns an array $result[0]=id and $result[1]=date etc
        return $result;

    }
}
