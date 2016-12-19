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
    public function getAllTimeslots() : array
    {
        return DB::select('SELECT * FROM timeslots');
    }

    public function getTimeslotById($id)
    {
        return DB::selectOne('SELECT * FROM timeslots WHERE timeslot_id = :timeslot_id', [
            'timeslot_id' => $id
        ]);
    }

    public function addTimeslot(Timeslot $timeslot) : bool
    {
        return DB::insert('INSERT INTO timeslots (start_time, end_time) VALUES (:start_time, :end_time)', [
            'start_time' => $timeslot->start_time,
            'end_time' => $timeslot->end_time
        ]);
    }

    public function updateTimeslot(Timeslot $timeslot) : int
    {
        return DB::update('UPDATE timeslots SET start_time = :start_time, end_time = :end_time WHERE timeslot_id = :timeslot_id', [
            'start_time' => $timeslot->start_time,
            'end_time' => $timeslot->end_time,
            'timeslot_id' => $timeslot->timeslot_id
        ]);
    }
}