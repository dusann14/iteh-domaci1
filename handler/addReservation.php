<?php

require "../dbBroker.php";
require "../model/rezervacija.php";

if (isset($_POST['userName']) && isset($_POST["knjigaId"])) {
    $status = Rezervacija::add($_POST['userName'], $_POST["knjigaId"], $conn);
    if ($status) {
        echo "Success";
    } else {
        echo $status;
        echo "Failed";
    }
}

?>