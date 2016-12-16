<?php
/**
 * Created by PhpStorm.
 * User: yasith
 * Date: 12/15/16
 * Time: 6:06 AM
 */

namespace App\VO;


class VOBase
{
    public function __construct($object = null)
    {
        $this->getObject($object);
    }

    private function getObject($parameters)
    {
        if (is_array($parameters) || is_object($parameters)) {
            foreach ($parameters as $key => $value) {
                if (property_exists(get_class($this), $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public static function getObjects($in_array){
        $out_array = array();
        foreach ($in_array as $p){
            $n = new CourseVO($p);
            array_push($out_array, $n);
        }
        return $out_array;
    }
}