<?php
namespace App\DAO;

use DB;
use Illuminate\Database\Connection;

abstract class ConnectionManager
{
    private static $connection;

    public static function getConnection(): Connection
    {
        // Check if connection already exists
        if (!isset(ConnectionManager::$connection)) {

            // Create new connection
            $con = DB::connection();

            // Check connection
            if ($con->getPdo() == null) {
                die("Connection failed: " . $con->getDatabaseName());
            }

            // Assign object to connection
            ConnectionManager::$connection = $con;
        }
        // Return existing connection
        return ConnectionManager::$connection;
    }

    /*
    |--------------------------------------------------------------------------
    | Commented methods
    |--------------------------------------------------------------------------
    */

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
