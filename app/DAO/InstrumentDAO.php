<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:07 AM
 */

namespace App\DAO;

use App\VO\InstrumentVO;
use DB;


class InstrumentDAO
{
    public function getAllInstruments()
    {
        return DB::select('SELECT * FROM instruments');
    }

    public function getInstrumentById($id)
    {
        return DB::selectOne('SELECT * FROM instruments WHERE instrument_id = :instrument_id', [
            'instrument_id' => $id
        ]);
    }

    public function addInstrument(InstrumentVO $instrument)
    {
        return DB::insert('INSERT INTO instruments (instrument_name) VALUES (:instrument_name)', [
            'instrument_name' => $instrument->instrument_name
        ]);
    }
}