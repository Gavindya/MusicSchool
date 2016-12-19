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
    public $student_firstname;
    public $student_lastname;
    public $student_address;
    public $student_telephone;
    public $student_joindate;

    /**
     * Student constructor.
     * @param null $student_firstname
     * @param $student_lastname
     * @param $student_address
     * @param $student_telephone
     */
    public function __construct($student_firstname, $student_lastname, $student_address, $student_telephone)
    {
        parent::__construct();
        $this->student_firstname = $student_firstname;
        $this->student_lastname = $student_lastname;
        $this->student_address = $student_address;
        $this->student_telephone = $student_telephone;
    }

}