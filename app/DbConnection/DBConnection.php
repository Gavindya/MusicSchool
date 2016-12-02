<?php
namespace App\DbConnection;

use mysqli;

class DBConnection
{

    public function openConnection()
    {
        $serverName = "localhost";
        $username = "musicschool";
        $password = "1234";

        // Create connection
        $conn = new mysqli($serverName, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";
        $sql = "USE MusicSchool";
        if ($conn->query($sql) === TRUE) {
            echo "Database connected successfully";
        } else {
            echo "Error connecting DB : " . $conn->error;
        }
        return $conn;
    }
    public function getName(){
        $conn = $this->openConnection();
        $sql = "SELECT students.name FROM students";
        $result = $conn->query($sql);
        $conn->close();
        return $result;

    }
}
