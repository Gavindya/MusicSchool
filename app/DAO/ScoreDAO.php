<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:04 AM
 */

namespace App\DAO;

use App\Domain\Score;
use DB;
use stdClass;

class ScoreDAO
{
    public function getScores($assignment_id): array
    {
        return DB::select(
            'SELECT * FROM scores WHERE assignment_id = :assignment_id', [
            'assignment_id' => $assignment_id]);
    }

    public function addScore(Score $score): bool
    {
        return DB::insert('INSERT INTO scores (assignment_id, score, enrolment_id) VALUES (:assignment_id, :score, :enrolment_id)', [
            'assignment_id' => $score->assignment_id,
            'score' => $score->score,
            'enrolment_id' => $score->enrolment_id
        ]);
    }

    public function getScoreForStudent($assignment_id, $enrolment_id): stdClass
    {
        return DB::selectOne(
            'SELECT * FROM scores WHERE assignment_id = :assignment_id AND enrolment_id = :enrolment_id', [
            'assignment_id' => $assignment_id,
            'enrolment_id' => $enrolment_id
        ]);
    }

    public function getStudentProgress($enrolment_id): stdClass
    {
        return DB::selectOne(
            'SELECT * FROM scores WHERE enrolment_id = :enrolment_id', [
            'enrolment_id' => $enrolment_id
        ]);
    }
}