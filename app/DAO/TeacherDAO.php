<?php

namespace App\DAO;

use App\Domain\Teacher;
use DB;
use stdClass;

class TeacherDAO
{
    public function getAllTeachers()
    {
        return DB::select('SELECT * FROM teachers');
    }

    public function getNames(): array
    {
        $conn = ConnectionManager::getConnection();
        $sql = "SELECT teachers.teacher_name,teacher_id FROM teachers";
        $statement = $conn->getPDO()->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getTeachers(): array
    {
        $conn = ConnectionManager::getConnection();
        $sql = "SELECT * FROM teachers";
        $result = $conn->getPDO()->query($sql)->fetchAll();
        return $result;
//        $statement = $conn->prepare($sql);
//        $statement->execute();
//        return $statement->fetch();
    }

    public function getATeacher($id): stdClass
    {
        $conn = ConnectionManager::getConnection();
        $sql = "SELECT * FROM `teachers` WHERE `teacher_id` = :id";
        $q = $conn->getPDO()->prepare($sql);
        $q->execute(array(':id' => "$id"));
        $done = $q->fetchObject();  //returns an array $done[0]=id and $done[1]=name
        return $done;
    }

    public function addNewTeacher(Teacher $teacher): bool
    {
        $conn = ConnectionManager::getConnection();
        $nameOfT = $teacher->getTeacherName();
        $address = $teacher->getTeacherAddress();
        $telephone = $teacher->getTeacherTelephone();
//        echo $nameOfT;
//        $sql = "INSERT INTO `teachers` (`teacher_name`, `teacher_address`, `teacher_telephone`,`teacher_joindate`)
//                VALUES ('{$nameOfT}','{$address}','{$telephone}','{$joined}')";
//        $conn->query($sql);
//        $conn->close();
        $sql = "INSERT INTO `teachers` (`teacher_name`, `teacher_address`, `teacher_telephone`,`teacher_joindate`)
                VALUES (:nameOfT,:address,:telephone, CURRENT_DATE())";
        $statement = $conn->getPdo()->prepare($sql);
        $statement->bindValue(":nameOfT", $nameOfT);
        $statement->bindValue(":address", $address);
        $statement->bindValue(":telephone", $telephone);
        return $statement->execute();
    }

    public function updateTeacher($telephone, $address, $id): int
    {
        $conn = ConnectionManager::getConnection();
        $sql = "UPDATE `teachers` SET `teacher_telephone` = :telephone,
                                      `teacher_address` = :address
                                      WHERE `teacher_id` = :id";
        $statement = $conn->getPdo()->prepare($sql);
//        $statement->execute(array(":mobile"=> "$mobile",":address"=> "$address",":telephone"=>"$telephone"));
        $statement->bindValue(":telephone", $telephone);
        $statement->bindValue(":address", $address);
        $statement->bindValue(":id", $id);
        return $statement->execute();
    }

    public function setArriveTime($id, $arrive): bool
    {
        $conn = ConnectionManager::getConnection();
        echo "arrive";
        $sql = "INSERT INTO `work` (`teacher_id`,`work_date`,`arrive_time`) VALUES (:id,CURRENT_DATE(),:arrive);";

        $statement = $conn->getPdo()->prepare($sql);
        $statement->bindValue(":arrive", $arrive);
        $statement->bindValue(":id", $id);
        return $statement->execute();
    }

    public function updateLeaveTime($id, $depart): int
    {
        $conn = ConnectionManager::getConnection();
        $sql = "UPDATE `work` SET `leave_time` = :depart
                                  WHERE `teacher_id` = :id AND `work_date` = CURRENT_DATE()";
        $statement = $conn->getPdo()->prepare($sql);
        $statement->bindValue(":depart", $depart);
        $statement->bindValue(":id", $id);
        return $statement->execute();
    }

    public function getAttendance($id): stdClass
    {
        $conn = ConnectionManager::getConnection();
        $sql = "SELECT * FROM `work` WHERE `work_date`= CURRENT_DATE() AND `teacher_id`=:id";
        $statement = $conn->getPdo()->prepare($sql);
        $statement->bindValue(":id", $id);
        return $statement->fetchObject();  //returns an array $result[0]=id and $result[1]=date etc
    }

    public function getWorkHours(): array
    {
        $conn = ConnectionManager::getConnection();
        $resultPeriod = $this->GetYearMonthString() . '%';

        $sql = "SELECT teacher_id,TotWorkTime_Teacher(:resultPeriod, teacher_id) AS tot FROM teachers WHERE TotWorkTime_Teacher(:resultPeriod, teacher_id) IS NOT NULL";
        $statement = $conn->getPdo()->prepare($sql);
        $statement->bindValue(":resultPeriod", $resultPeriod);
        $statement->execute();
        $result = $statement->fetchAll();  //returns an array $result[0]=id and $result[1]=date etc
        return $result;
    }

    //////// METHODS IMPLEMENTED IN MY SECTION (YASITH) :) DONT DELETE

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

    public function getTeacherById($id)
    {
        return DB::selectOne('SELECT * FROM teachers WHERE teacher_id = :teacher_id', [
            'teacher_id' => $id
        ]);
    }

    public function addTeacher(Teacher $teacher)
    {
        return DB::insert('INSERT INTO teachers (teacher_name, teacher_address, teacher_telephone) VALUES (:teacher_name, :teacher_address, :teacher_telephone )', [
            'teacher_name' => $teacher->teacher_name,
            'teacher_address' => $teacher->teacher_address,
            'teacher_telephone' => $teacher->teacher_telephone
        ]);
    }

}