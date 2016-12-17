<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:11 AM
 */

namespace App\Domain;


class Student extends BaseModel
{
    public $student_id;
    public $student_name;
    public $student_address;
    public $student_telephone;
    public $student_joindate;

    /**
     * Student constructor.
     * @param $student_name
     * @param $student_address
     * @param $student_telephone
     */
    public function __construct($student_name, $student_address, $student_telephone)
    {
        parent::__construct();
        $this->student_name = $student_name;
        $this->student_address = $student_address;
        $this->student_telephone = $student_telephone;
    }


}