<?php

class Clan{

    public $userName;
    public $ime;
    public $prezime;
    public $email;
    public $pass;

    public function __construct($userName, $ime, $prezime, $email, $pass)
    {
        $this->userName = $userName;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->email = $email;
        $this->pass = $pass;

    }



}

?>