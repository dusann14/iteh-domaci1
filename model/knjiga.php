<?php

class Knjiga{

    public $knjigaId;
    public $naslov;
    public $autor;
    public $godinaNastanka;
    public $cena;

    public function __construct($knjigaId, $naslov, $autor, $godinaNastanka, $cena)
    {
        $this->knjigaId = $knjigaId;
        $this->naslov = $naslov;
        $this->autor = $autor;
        $this->godinaNastanka = $godinaNastanka;
        $this->cena = $cena;
    }

    



}


?>