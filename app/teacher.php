<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    protected $fillable = ['name'];
    public $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
