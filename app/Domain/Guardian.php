<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 5:09 AM
 */

namespace App\Domain;


class Guardian extends BaseModel
{
    public $guardian_id;
    public $guardian_name;
    public $guardian_telephone;

    /**
     * Guardian constructor.
     * @param $guardian_name
     * @param $guardian_telephone
     */
    public function __construct($guardian_name, $guardian_telephone)
    {
        parent::__construct();
        $this->guardian_name = $guardian_name;
        $this->guardian_telephone = $guardian_telephone;
    }


}