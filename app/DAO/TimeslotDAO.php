<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:04 AM
 */

namespace App\DAO;

use App\Domain\Timeslot;
use DB;

class TimeslotDAO
{
    public function getAllTimeslots()
    {
        return DB::select('SELECT * FROM timeslots');
    }

    public function getTimeslotById($id)
    {
        return DB::selectOne('SELECT * FROM timeslots WHERE timeslot_id = :timeslot_id', [
            'timeslot_id' => $id
        ]);
    }

    public function addTimeslot(Timeslot $timeslot)
    {
        return DB::insert('INSERT INTO timeslots (start_time, end_time) VALUES (:start_time, :end_time)', [
            'start_time' => $timeslot->start_time,
            'end_time' => $timeslot->end_time
        ]);
    }
}