<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:07 AM
 */

namespace App\DAO;

use App\Domain\Instrument;
use DB;
use stdClass;

class InstrumentDAO
{
    public function getAllInstruments()
    {
        return DB::select('SELECT * FROM instruments');
    }

    public function getInstrumentsAll()
    {
        $instruments = DB::select('SELECT * FROM instruments');
        $instrumentsResults = json_decode(json_encode($instruments), TRUE);
        return $instrumentsResults;
    }

    public function getInstrumentById($id)
    {
        return DB::selectOne('SELECT * FROM instruments WHERE instrument_id = :instrument_id', [
            'instrument_id' => $id
        ]);
    }

    public function addInstrument(Instrument $instrument)
    {
        return DB::insert('INSERT INTO instruments (instrument_name) VALUES (:instrument_name)', [
            'instrument_name' => $instrument->instrument_name
        ]);
    }

    public function updateInstrument(Instrument $instrument): int
    {
        return DB::update('UPDATE instruments SET instrument_name = :instrument_name WHERE instrument_id = :instrument_id', [
            'instrument_name' => $instrument->instrument_name,
            'instrument_id' => $instrument->instrument_id
        ]);
    }
    public function getInstrumentsForTeacher($id){
        $instruments = DB::select('SELECT instruments.instrument_name FROM teaches
                                  LEFT JOIN instruments on teaches.instrument_id = instruments.instrument_id
                                  WHERE teaches.teacher_id=:id', ['id' => $id]);
        $instrumentsResults =json_decode(json_encode($instruments), TRUE);
        return $instrumentsResults;
    }
}