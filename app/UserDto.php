<?php

namespace App;

class UserDto
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public $nama;
    public $email;
    public $no_telp;

    public function MapUser($name , $email , $no_telp){
        $this->nama = $name ;
        $this->email = $email;
        $this->no_telp = $no_telp;
    }
}
