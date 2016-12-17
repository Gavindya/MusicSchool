<?php

namespace App\Http\Controllers;
use App\DbModels\GuardiansTableConnector;
use Illuminate\Http\Request;
use mysqli;

class GuardianController extends Controller
{
    //


    /**
     * @param Request $request
     * @return mixed
     */
    public function storeGuardian( mysqli $conn,Request $request)
    {


        $guardianConnector = new GuardiansTableConnector();

        $result = $guardianConnector->storeGuardian( $conn,$request);
        return $result;
    }
}
