<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:06 AM
 */

namespace App\DAO;

use DB;

class TeachesDAO
{
    public function getTeachersByInstrument($instrument_id)
    {
        return DB::select('SELECT teacher_id id, teacher_name name FROM teachers NATURAL JOIN teaches WHERE instrument_id = :instrument_id', [
            'instrument_id' => $instrument_id
        ]);
    }

    public function getInstrumentsByTeacher($teacher_id)
    {
        return DB::select('SELECT instrument_id id, instrument_name name FROM instruments NATURAL JOIN teaches WHERE teacher_id = :teacher_id', [
            'teacher_id' => $teacher_id
        ]);
    }
}