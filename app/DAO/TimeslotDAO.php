<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:04 AM
 */

namespace App\DAO;

use App\VO\TimeslotVO;
use DB;

class TimeslotDAO
{
    public function getAllTimeslots(){
        $results = DB::select('SELECT * FROM timeslots');
        foreach ($results as $params){
            yield new TimeslotVO($params);
        }
    }
}