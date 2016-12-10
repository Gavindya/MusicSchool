<?php
namespace App\DbConnection;

use mysqli;

class DBConnection
{
    private static $conn;

    public static function openConnection()
    {
        $serverName = "localhost";
        $username = "musicschool";
        $password = "1234";

        if (!isset(DBConnection::$conn)) {
    
        // Create connection
            DBConnection::$conn = new mysqli($serverName, $username, $password);


            // Check connection
            if (DBConnection::$conn->connect_error) {
                die("Connection failed: " . DBConnection::$conn->connect_error);
        }
        }
        //echo "Connected successfully";
        $sql = "USE musicschool_";
        if (DBConnection::$conn->query($sql) === TRUE) {
            // echo "Database connected successfully";
        } else {
            echo "Error connecting DB : " . DBConnection::$conn->error;
        }
        return DBConnection::$conn;
    }
    /*  public function getName(){
          $conn = $this->openConnection();
          $sql = "SELECT students.name FROM students";
          $result = $conn->query($sql);
          $conn->close();
          return $result;
  
      }
  
      public function storeStudent(Request $request)
      {
          $conn = $this->openConnection();
          //$sql="INSERT INTO `students` (`id`, `name`) VALUES (NULL,dileka)";
          $sql="INSERT INTO `students`(`id`, `name`, `address`, `telephone`, `family_id`, `created_at`, `updated_at`) VALUES (NULL ,'{$request->first_name}','{$request->student_address}','{$request->student_telephone}','1',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
          $result = $conn->query($sql);
          $conn->close();
          return $result;
      }
  
      public function storeGuardian(Request $request){
  
          $conn = $this->openConnection();
          //$sql="INSERT INTO `students` (`id`, `name`) VALUES (NULL,dileka)";
          $sql="INSERT INTO `guardians`(`id`, `name`, `telephone`, `created_at`, `updated_at`) VALUES (NULL ,'{$request->guardian_name}','{$request->guardian_phone}',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
          $result = $conn->query($sql);
          $conn->close();
          return $result;
      }
  
      public function getStudents()
      {
          $conn = $this->openConnection();
          $sql = "SELECT * FROM students";
          $result = $conn->query($sql);
          $conn->close();
          return $result;
  
      }
      public function addClass(Request $request)
      {
          $conn = $this->openConnection();
          $sql = "INSERT INTO `enrolls` (`id`, `student_id`, `class_id`, `active`, `created_at`, `updated_at`) VALUES (NULL, '{$request->student_id}', '{$request->class_id}', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
          $result = $conn->query($sql);
          $conn->close();
          return $result;
  
      }*/
}
