<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:04 AM
 */

namespace App\DAO;

use App\Domain\StudentAssignment;
use DB;

class AssignmentDAO
{
    public function getAssignments($course_id)
    {
        return DB::select(
            'SELECT * FROM assignments WHERE course_id = :course_id', [
            'course_id' => $course_id
        ]);
    }

    public function addAssignment(StudentAssignment $assignment)
    {
        return DB::insert('INSERT INTO assignments (asignment_title, marks, course_id) VALUES (:assignment_title, :marks, :course_id)', [
            'assignment_title' => $assignment->title,
            'marks' => $assignment->marks,
            'course_id' => $assignment->course_id
        ]);
    }
}