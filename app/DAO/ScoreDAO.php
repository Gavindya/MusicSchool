<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:04 AM
 */

namespace App\DAO;

use App\VO\ScoreVO;
use DB;

class ScoreDAO
{
    public function getScores($assignment_id)
    {
        return DB::select(
            'SELECT * FROM scores WHERE assignment_id = :assignment_id', [
            'assignment_id' => $assignment_id]);
    }

    public function addScore(ScoreVO $score)
    {
        return DB::insert('INSERT INTO scores (assignment_id, score, enrolment_id) VALUES (:assignment_id, :score, :enrolment_id)', [
            'assignment_id' => $score->assignment_id,
            'score' => $score->score,
            'enrolment_id' => $score->enrolment_id
        ]);
    }

    public function getScoreForStudent($assignment_id, $enrolment_id)
    {
        return DB::selectOne(
            'SELECT * FROM scores WHERE assignment_id = :assignment_id AND enrolment_id = :enrolment_id', [
            'assignment_id' => $assignment_id,
            'enrolment_id' => $enrolment_id
        ]);
    }
}