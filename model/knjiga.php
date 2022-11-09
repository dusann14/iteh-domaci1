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

    public static function add($naslov, $autor, $godinaNastanka, $cena, mysqli $conn)
    {
        $q = "INSERT INTO knjiga(naslov, autor, godinaNastanka, cena) VALUES('$naslov', '$autor', $godinaNastanka,  $cena)";
        return $conn->query($q);
    }

    public static function getAll(mysqli $conn){
        $q = "SELECT * FROM knjiga";
        return $conn->query($q);
    }

    public static function getLastId(mysqli $conn){
        $q = "SELECT knjigaId FROM knjiga ORDER BY knjigaId DESC LIMIT 1";
        return $conn->query($q);
    }

    public static function getByBookId($knjigaId, $conn){
        $q = "SELECT knjigaId, naslov, autor, godinaNastanka FROM knjiga WHERE knjigaId = $knjigaId";
        return $conn->query($q);
    }

    public static function getByAutor($autor, $conn){
        $q = "SELECT * FROM knjiga WHERE autor = '$autor'";
        return $conn->query($q);
    }

    public static function sortTable($conn){
        $q = "SELECT * FROM knjiga ORDER BY naslov ASC";
        return $conn->query($q);
    }

    public static function deleteById($knjigaId, mysqli $conn)
    {
        $q = "DELETE FROM knjiga WHERE knjigaId=$knjigaId";
        return $conn->query($q);
    }

}


?>