<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 2:04 AM
 */

namespace App\Domain;

class StudentAssignment extends BaseModel
{
    public $assignment_id;
    public $course_id;
    public $title;
    public $marks;

    /**
     * StudentAssignment constructor.
     * @param $course_id
     * @param $title
     * @param $marks
     */
    public function __construct($course_id, $title, $marks)
    {
        $this->course_id = $course_id;
        $this->title = $title;
        $this->marks = $marks;
    }


}