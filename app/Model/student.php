<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{

    protected $fillable = ['name', 'address', 'telephone', 'family_id'];


    public function getName()
    {
        return $this->name;
    }

    public function getTelephoneNumber()
    {
        return $this->telephoneNo;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getId()
    {
        return $this->id;
    }
}
