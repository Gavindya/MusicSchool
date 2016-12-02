<?php
namespace App\Http\Controllers;

use mysqli;

class DBConnection
{

    public function openConnection()
    {
        $serverName = "localhost";
        $username = "root";
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
        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);
       // return $result->fetch_assoc();
//        return $result;
        echo $result->fetch_assoc()[0]->name;
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "name: " . $row["name"]. "<br>";
            }
        } else {
            echo "0 results";
        }
    }
}
