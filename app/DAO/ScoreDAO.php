<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:04 AM
 */

namespace App\DAO;

use app\VO\ScoreVO;
use DB;

class ScoreDAO
{
    public function getScores($assignment_id)
    {
        $results = DB::select(
            'SELECT * FROM scores WHERE assignment_id = :assignment_id', [
            'assignment_id' => $assignment_id
        ]);
        foreach ($results as $params){
            yield new ScoreVO($params);
        }
    }
}