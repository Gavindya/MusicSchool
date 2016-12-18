<?php

namespace App\Http\Controllers;

use App\DAO\InstrumentDAO;
use App\DAO\TimeslotDAO;
use App\Domain\Instrument;
use App\Domain\Timeslot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SchoolAdministrationController extends Controller
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

    public function showSchoolAdministration(): View
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

    public function addTimeslot(Request $request): RedirectResponse
    {
        $object = $request->all();
        $timeslot = new Timeslot($object['start_time'], $object['end_time']);
        $timeslotDAO = new TimeslotDAO();
        $timeslotDAO->addTimeslot($timeslot);
        return redirect()->back();
    }

    public function updateTimeslot(Request $request): RedirectResponse
    {
        $object = $request->all();
        $timeslot = new Timeslot($object['start_time'], $object['end_time']);
        $timeslot->timeslot_id = $object['timeslot_id'];
        $timeslotDAO = new TimeslotDAO();
        $timeslotDAO->updateTimeslot($timeslot);
        return redirect()->back();
    }

    public function addInstrument(Request $request): RedirectResponse
    {
        $object = $request->all();
        $instrument = new Instrument($object['instrument_name']);
        $instrumentDAO = new InstrumentDAO();
        $instrumentDAO->addInstrument($instrument);
        return redirect()->back();
    }

    public function updateInstrument(Request $request): RedirectResponse
    {
        $object = $request->all();
        $instrument = new Instrument($object['instrument_name']);
        $instrument->instrument_id = $object['instrument_id'];
        $instrumentDAO = new InstrumentDAO();
        $instrumentDAO->updateInstrument($instrument);
        return redirect()->back();
    }
}
