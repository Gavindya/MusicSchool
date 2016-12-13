<?php

namespace App\Http\Controllers;

class ClsController extends Controller
{
    public function getAssignedClasDetails($id)
    {
        $clsDetails = array();
        array_push($clsDetails, 1);
        array_push($clsDetails, $id);
        array_push($clsDetails, 2);
        array_push($clsDetails, 1500);
        array_push($clsDetails, "4:30");
        array_push($clsDetails, "6:30");
        return $clsDetails;
    }
}
