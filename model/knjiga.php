<?php

class Knjiga{

    public $id;
    public $naslov;
    public $autor;
    public $godinaNastanka;
    public $cena;

    public function __construct($id, $naslov, $autor, $godinaNastanka, $cena)
    {
        $this->id = $id;
        $this->naslov = $naslov;
        $this->autor = $autor;
        $this->godinaNastanka = $godinaNastanka;
        $this->cena = $cena;
    }

    



}


?>