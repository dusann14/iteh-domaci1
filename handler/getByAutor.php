<?php

require "../dbBroker.php";
require "../model/knjiga.php";

if (isset($_POST['autor'])) {
    $status = Knjiga::getByAutor($_POST['autor'], $conn);
    if ($status) {
        while ($red = $status->fetch_array()) {
            echo json_encode($red);
        }
    } else {
        echo $status;
        echo "Failed";
    }
}

?>