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
    public function getAllInstruments(): array
    {
        return DB::select('SELECT * FROM instruments');
    }

    public function getInstrumentsAll()
    {
        $instruments = DB::select('SELECT * FROM instruments');
        $instrumentsResults = json_decode(json_encode($instruments), TRUE);
        return $instrumentsResults;
    }

    public function getInstrumentById($id): stdClass
    {
        return DB::selectOne('SELECT * FROM instruments WHERE instrument_id = :instrument_id', [
            'instrument_id' => $id
        ]);
    }

    public function addInstrument(Instrument $instrument): bool
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
}