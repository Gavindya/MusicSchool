<?php

namespace App\Http\Controllers;

use App\DAO\InstrumentDAO;
use App\DAO\TimeslotDAO;
use App\VO\InstrumentVO;
use App\VO\TimeslotVO;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addTimeslot(Request $request)
    {
        $object = $request->all();
        $timeslot = new TimeslotVO($object['start_time'], $object['end_time']);
        $timeslotDAO = new TimeslotDAO();
        $timeslotDAO->addTimeslot($timeslot);
    }

    public function addInstrument(Request $request)
    {
        $object = $request->all();
        $instrument = new InstrumentVO($object['instrument_name']);
        $instrumentDAO = new InstrumentDAO();
        $instrumentDAO->addInstrument($instrument);
    }
}
