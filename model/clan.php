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

    public static function logIn($userName, $pass, mysqli $conn){
        $q = "select * from clan where userName= '$userName' and pass ='$pass' limit 1;";
        return $conn->query($q);
    }

    public static function check($userName, $conn){
        $q = "select * from clan where userName= '$userName'";
        return $conn->query($q);
    }

    public static function getByUserName($userName, mysqli $conn){
        $q = "SELECT * FROM tim WHERE userName = '$userName'";
        $myArray = array();
        if ($result = $conn->query($q)) {
            while ($row = $result->fetch_array(1)) {
                $myArray[] = $row;
            }
        }
        return $myArray;
    }

    public static function add($userName, $ime, $prezime, $email, $pass, mysqli $conn)
    {

        $q = "INSERT INTO clan(userName, ime, prezime, email, pass) VALUES('$userName', '$ime', '$prezime',  '$email', '$pass')";
        return $conn->query($q);
    }

}

?>