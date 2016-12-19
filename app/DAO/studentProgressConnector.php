<?php
/**
 * Created by PhpStorm.
 * User: Dileka
 * Date: 12/11/2016
 * Time: 7:10 AM
 */

namespace app\DbModels;


use mysqli;

class studentProgressConnector
{
    public function getStudentProgress(mysqli $conn, $student_id)
    {

        // $conn = DBConnection::openConnection();
        $sql = "SELECT students.id, assignments.enrolment_id, scores.assignment_id,assignments.tiltle,scores.score FROM `students` JOIN `enrolls` ON students.id=enrolls.student_id JOIN assignments on assignments.enrolment_id=enrolls.id join scores on scores.assignment_id=assignments.id where students.id=$student_id";
        $result = $conn->query($sql);

        //$conn->close();
        $student_progress = array();
        while ($row = $result->fetch_assoc()) {

            array_push($student_progress, $row);
        }


        return [$conn, $student_progress];


    }


}