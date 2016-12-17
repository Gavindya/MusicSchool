<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:08 AM
 */

namespace App\Domain;


class Family extends BaseModel
{
    public $student_id;
    public $parent_id;
    public $relationship;
}