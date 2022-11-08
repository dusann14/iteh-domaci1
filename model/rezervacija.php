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

    public static function add($userName, $knjigaId, mysqli $conn){
        $q = "INSERT INTO rezervacija(userName, knjigaId) VALUES('$userName', $knjigaId)";
        return $conn->query($q);
    }

    public static function getByUserName($userName, $conn){
        $q = "SELECT knjigaId, naslov, autor, godinaNastanka FROM knjiga WHERE knjigaId IN (SELECT knjigaId FROM rezervacija WHERE userName = '$userName')";
        return $conn->query($q);
    }

}


?>