<?php
namespace App\DbConnection;

use App\teacher;

class TeacherDAO
{
    public function getName()
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openConnection();
        $sql = "SELECT teachers.teacher_name FROM teachers";
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
        $sql = "SELECT * FROM `teachers` WHERE `teacher_id` = :id";
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
        $address = $teacher->getAddress();
        $joined = $teacher->getJoindate();
        $telephone = $teacher->getTelephone();
        echo $nameOfT;
        $sql = "INSERT INTO `teachers` (`teacher_name`, `teacher_address`, `teacher_telephone`,`teacher_joindate`)
                VALUES ('{$nameOfT}', '{$address}','{$telephone}','{$joined}')";
        $conn->query($sql);
        $conn->close();
    }

    public function updateTeacher($telephone, $address, $id)
    {
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $sql = "UPDATE `teachers` SET `teacher_telephone` = :telephone,
                                      `teacher_address` = :address
                                      WHERE `teacher_id` = :id";
        $statement = $conn->prepare($sql);
//        $statement->execute(array(":mobile"=> "$mobile",":address"=> "$address",":telephone"=>"$telephone"));
        $statement->bindValue(":telephone", $telephone);
        $statement->bindValue(":address", $address);
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

    public function recordAttendence($id, $arrive, $depart)
    {
        $today = date("y-m-d");
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $sql = "INSERT INTO `work` (`teacher_id`, `work_date`, `arrive_time`, `leave_time`) VALUES (:id,:today,:arrive,:depart)";
        $statement = $conn->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->bindValue(":today", $today);
        $statement->bindValue(":arrive", $arrive);
        $statement->bindValue(":depart", $depart);
        $statement->execute();
    }

    public function setArriveTime($id, $arrive)
    {
        $today = date("y-m-d");
        echo $today;
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        echo "arrive";
        $sql = "INSERT INTO `work` (`teacher_id`,`work_date`,`arrive_time`) VALUES (:id,:today,:arrive);";
        $statement = $conn->prepare($sql);
        $statement->bindValue(":today", $today);
        $statement->bindValue(":arrive", $arrive);
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

    public function updateLeaveTime($id, $depart)
    {
        $today = date("y-m-d");
        $dbCon = new DBConnection();
        $conn = $dbCon->openPDO();
        $sql = "UPDATE `work` SET `leave_time` = :depart
                                  WHERE `teacher_id` = :id AND `work_date` = :today";
        $statement = $conn->prepare($sql);
        $statement->bindValue(":today", $today);
        $statement->bindValue(":depart", $depart);
        $statement->bindValue(":id", $id);
        $statement->execute();
    }
    public function getAttendence($id)
    {
        $today = date("y-m-d");
        $dbcon = new DBConnection();
        $conn = $dbcon->openPDO();
        $sql = "SELECT * FROM `work` WHERE `work_date`=:today AND `teacher_id`=:id";
        $statement = $conn->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->bindValue(":today", $today);
        $statement->execute();
        $result = $statement->fetch();  //returns an array $result[0]=id and $result[1]=date etc
        return $result;

    }
}
