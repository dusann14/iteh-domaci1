<?php

class Rezervacija{

    public $userName;
    public $knjigaId;

    public function __construct($userName, $knjigaId)
    {
        $this->userName = $userName;
        $this->knjigaId = $knjigaId;
    }

}


?>