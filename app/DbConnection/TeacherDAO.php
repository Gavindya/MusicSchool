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

    public function addNewTeacher(teacher $teacher)
    {
        echo "*received in teacher DAO-/-*";
        $dbCon = new DBConnection();
        $conn = $dbCon->openConnection();
        $nameOfT = $teacher->getName();
        echo "**name of the teacher---";
        echo $nameOfT;
        $sql = "INSERT INTO `teachers` (`id`, `name`, `created_at`, `updated_at`) VALUES (NULL, '{$nameOfT}', NULL, NULL)";
        $conn->query($sql);
        echo "***sql query ran***";
        $conn->close();
    }
}
