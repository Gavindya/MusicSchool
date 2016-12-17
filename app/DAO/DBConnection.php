<?php
namespace App\DAO;

use mysqli;
use PDO;

class DBConnection
{

    public function openConnection()
    {
        $serverName = "localhost";
        $username = "musicschool";
        $password = "1234";

        $conn = new mysqli($serverName, $username, $password);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully           ";
        $sql = "USE MusicSchool";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error connecting DB : " . $conn->error;
        }
        return $conn;
    }
    public function getName(){
        $conn = $this->openConnection();
        $sql = "SELECT student_name FROM students";
        $result = $conn->query($sql);
        $conn->close();
        return $result;

    }

    public function openPDO()
    {
        $server = 'mysql:dbname=musicschool;host=127.0.0.1';
        $username = "musicschool";
        $password = "1234";

        $conn = new PDO($server, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
}
