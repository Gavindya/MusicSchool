<?php

namespace App\Http\Controllers;

use App\DAO\InstrumentDAO;
use App\DAO\TimeslotDAO;
use App\Domain\Instrument;
use App\Domain\Timeslot;
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

    public function showSchoolAdministration()
    {
        $timeslotDAO = new TimeslotDAO();
        $instrumentDAO = new InstrumentDAO();

        $timeslots = $timeslotDAO->getAllTimeslots();
        $instruments = $instrumentDAO->getAllInstruments();

        return view('administration.school-administration', [
            'timeslots' => $timeslots,
            'instruments' => $instruments
        ]);
    }

    public function addTimeslot(Request $request)
    {
        $object = $request->all();
        $timeslot = new Timeslot($object['start_time'], $object['end_time']);
        $timeslotDAO = new TimeslotDAO();
        $timeslotDAO->addTimeslot($timeslot);
    }

    public function addInstrument(Request $request)
    {
        $object = $request->all();
        $instrument = new Instrument($object['instrument_name']);
        $instrumentDAO = new InstrumentDAO();
        $instrumentDAO->addInstrument($instrument);
    }
}
