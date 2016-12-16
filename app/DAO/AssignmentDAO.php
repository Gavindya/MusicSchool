<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:04 AM
 */

namespace App\DAO;

use App\VO\AssignmentVO;
use DB;

class AssignmentDAO
{
    public function getAssignments($course_id)
    {
        $results = DB::select(
            'SELECT * FROM assignments WHERE course_id = :course_id', [
            'course_id' => $course_id
        ]);

        // ORM
        foreach ($results as $params) {
            yield new AssignmentVO($params);
        }
    }
}