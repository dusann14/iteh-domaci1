<?php

class Clan{

    public $userName;
    public $ime;
    public $prezime;
    public $email;
    public $pass;
    public $knjige;

    public function __construct($userName, $ime, $prezime, $email, $pass, $knjige)
    {
        $this->userName = $userName;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->email = $email;
        $this->pass = $pass;
        $this->knjige = $knjige;
    }



}

?>