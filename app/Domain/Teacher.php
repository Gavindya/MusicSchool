<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 1:51 AM
 */

namespace App\Domain;


class Teacher extends BaseModel
{
    public $teacher_id;
    public $teacher_name;
    public $teacher_address;
    public $teacher_telephone;
    public $teacher_joindate;

    public static function generateMonthlySalary($workingHoursArray)
    {
        $paymentperHour = 2000;
        $paymentsArr = array();
        foreach ($workingHoursArray as $t) {
            $t['tot'] = (integer)($t['tot'] * $paymentperHour);
            $element = array();
            $element['teacher_id'] = $t['teacher_id'];
            $element['tot'] = $t['tot'];
            array_push($paymentsArr, $element);
        }
        return $paymentsArr;
    }

    /**
     * @return mixed
     */
    public function getTeacherId()
    {
        return $this->teacher_id;
    }

    /**
     * @param mixed $teacher_id
     */
    public function setTeacherId($teacher_id)
    {
        $this->teacher_id = $teacher_id;
    }

    /**
     * @return mixed
     */
    public function getTeacherName()
    {
        return $this->teacher_name;
    }

    /**
     * @param mixed $teacher_name
     */
    public function setTeacherName($teacher_name)
    {
        $this->teacher_name = $teacher_name;
    }

    /**
     * @return mixed
     */
    public function getTeacherAddress()
    {
        return $this->teacher_address;
    }

    /**
     * @param mixed $teacher_address
     */
    public function setTeacherAddress($teacher_address)
    {
        $this->teacher_address = $teacher_address;
    }

    /**
     * @return mixed
     */
    public function getTeacherTelephone()
    {
        return $this->teacher_telephone;
    }

    /**
     * @param mixed $teacher_telephone
     */
    public function setTeacherTelephone($teacher_telephone)
    {
        $this->teacher_telephone = $teacher_telephone;
    }

    /**
     * @return mixed
     */
    public function getTeacherJoindate()
    {
        return $this->teacher_joindate;
    }

    /**
     * @param mixed $teacher_joindate
     */
    public function setTeacherJoindate($teacher_joindate)
    {
        $this->teacher_joindate = $teacher_joindate;
    }

}