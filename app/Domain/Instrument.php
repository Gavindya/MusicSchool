<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:08 AM
 */

namespace App\Domain;


class Instrument extends BaseModel
{
    public $instrument_id;
    public $instrument_name;

    /**
     * InstrumentVO constructor.
     * @param $instrument_name
     */
    public function __construct($instrument_name)
    {
        parent::__construct();
        $this->instrument_name = $instrument_name;
    }
}