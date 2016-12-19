<?php

namespace App\Http\Controllers;

use App\DAO\GuardianDAO;
use App\Domain\Guardian;
use Illuminate\Http\Request;

class GuardianController extends Controller
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


    /**
     * @param Request $request
     * @return mixed
     */
    public function addGuardian(Request $request)
    {
        $guardianConnector = new GuardianDAO();
        $object = $request->all();
        $guardian = new Guardian($object['guardian_name'], $object['guardian_phone']);
        return $guardianConnector->addGuardian($guardian);
    }
}
