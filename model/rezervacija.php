<?php

class Rezervacija{

    public $rezervacijaId;
    public $userName;
    public $knjigaId;

    public function __construct($rezervacijaId ,$userName, $knjigaId)
    {
        $this->rezervacijaId = $rezervacijaId;
        $this->userName = $userName;
        $this->knjigaId = $knjigaId;
    }

}


?>