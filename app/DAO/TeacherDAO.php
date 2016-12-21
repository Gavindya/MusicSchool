<?php

namespace App\DAO;

use App\Domain\Teacher;
use DB;
use Crypt;
use Exception;

class TeacherDAO
{
    public function getAllTeachers()
    {
        $teachers = DB::select('SELECT * FROM teachers');
        $teachers = json_decode(json_encode($teachers), TRUE);
        return $teachers;
    }

    public function getNames()
    {
        return DB::select('SELECT teacher_name,teacher_id FROM teachers');
    }

    public function getATeacher($id)
    {
        $teacher = DB::selectOne('SELECT * FROM `teachers` WHERE `teacher_id` = :id',
            ['id' => $id]);
        $teacher = json_decode(json_encode($teacher), TRUE);
        return $teacher;
    }

    public function addNewTeacher(Teacher $teacher)
    {
        $nameOfT = $teacher->getTeacherName();
        $address = $teacher->getTeacherAddress();
        $joined = $teacher->getTeacherJoindate();
        $telephone = $teacher->getTeacherTelephone();

        return DB::insert(
            'INSERT INTO `teachers` (`teacher_name`, `teacher_address`, `teacher_telephone`,`teacher_joindate`,`username`)
                VALUES (:nameOfT,:address,:telephone,:joined,:username)', [
            'nameOfT' => $nameOfT,
            'username' => $nameOfT,
            'address' => $address,
            'telephone' => $telephone,
            'joined' => $joined
        ]);
    }

    public function updateTeacher($telephone, $address, $id,$newInstrument_id)
    {
        DB::beginTransaction();
        try{
            DB::update(
            'UPDATE `teachers` SET `teacher_telephone` = :telephone,
                                      `teacher_address` = :address
                                      WHERE `teacher_id` = :id', [
            'address' => $address,
            'telephone' => $telephone,
            'id' => $id
            ]);
            DB::insert(
                'INSERT INTO `teaches` VALUES (:teacher_id,:instrument_id)', [
                'teacher_id' => $id,
                'instrument_id' => $newInstrument_id
            ]);
//            $error = 'Always throw this error';
//            throw new Exception($error);
            DB::commit();
            return "1";
        }
        catch (Exception $ex)
        {
            DB::rollBack();
            return "0";
        }
        
    }

    public function updateUser($username,$pw){

        $password = Crypt::encrypt($pw);
        $decrypted = Crypt::decrypt($password);

//        return DB::update(
//            'UPDATE `users` SET `password` = :pw WHERE `username` = :username', [
//            'password' => $password,
//            'username' => $username ]);
    }

    public function recordAttendence($id, $arrive, $depart)
    {
        $today = date("y-m-d");
        return DB::insert(
            'INSERT INTO `work` (`teacher_id`, `work_date`, `arrive_time`, `leave_time`)
                VALUES (:id,:today,:arrive,:depart)', [
            'id' => $id,
            'today' => $today,
            'arrive' => $arrive,
            'depart' => $depart
        ]);
    }

    public function setArriveTime($id, $arrive)
    {
        $today = date("y-m-d");
        return DB::insert(
            'INSERT INTO `work` (`teacher_id`,`work_date`,`arrive_time`) VALUES (:id,:today,:arrive)', [
            'id' => $id,
            'today' => $today,
            'arrive' => $arrive
        ]);
    }

    public function updateLeaveTime($id, $depart)
    {
        $today = date("y-m-d");
        return DB::update(
            'UPDATE `work` SET `leave_time` = :depart
                                  WHERE `teacher_id` = :id AND `work_date` = :today', [
            'id' => $id,
            'today' => $today,
            'depart' => $depart
        ]);
    }

    public function getAttendence($id)
    {
        $today = date("y-m-d");
        $result = DB::selectOne('SELECT * FROM `work` WHERE `work_date`=:today AND `teacher_id`=:id', ['id' => $id, 'today' => $today]);
        $result = json_decode(json_encode($result), TRUE);
//        echo dd($result);
        return $result;
    }

    public function getWorkHours()
    {
        $month = date("m");
        $time = strtotime(date("y-m-d"));
        $year = date("Y", $time);
        $resultPeriod = $year . '-' . $month . '%';
        $resultsNotNull = array();
//        $result =  DB::select('SELECT teacher_id,TotWorkTime_Teacher(:resultPeriod, teacher_id) AS tot FROM teachers
//                WHERE TotWorkTime_Teacher(:resultPeriod, teacher_id) IS NOT NULL', [
//            'resultPeriod' => $resultPeriod]);
        $result = DB::select('SELECT teacher_id, TotWorkTime_Teacher(:resultPeriod, teacher_id)
                  AS tot FROM teachers', [
            'resultPeriod' => $resultPeriod]);

        $result = json_decode(json_encode($result), TRUE);
        foreach ($result as $r) {
            if ($r['tot'] != null) {
                array_push($resultsNotNull, $r);
            }
        }
        return $resultsNotNull;
    }
    
    public function setTeacherNotActive($id){
        $q = DB::update(
            "UPDATE `teachers` SET `active` = 0 WHERE `teacher_id` = :id ", [
            'id' => $id ]);
        
        if($q===1){
            return "Successfully resigned teacher";
        }
        else{
            return "Problem occured in resigning teacher";
        }
        
    }

    //////// METHODS IMPLEMENTED IN MY SECTION (YASITH) :) DONT DELETE

    public function getAllTeachersAsObj()
    {
        return DB::select('SELECT * FROM teachers');
    }

    public function getTeacherById($id)
    {
        return DB::selectOne('SELECT * FROM teachers WHERE teacher_id = :teacher_id', [
            'teacher_id' => $id
        ]);
    }

    public function addTeacher(Teacher $teacher)
    {
        return DB::insert('INSERT INTO teachers (teacher_name, teacher_address, teacher_telephone) 
                    VALUES (:teacher_name, :teacher_address, :teacher_telephone )', [
            'teacher_name' => $teacher->getTeacherName(),
            'teacher_address' => $teacher->getTeacherAddress(),
            'teacher_telephone' => $teacher->getTeacherTelephone()
        ]);
    }

}