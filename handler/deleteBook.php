<?php

require "../dbBroker.php";
require "../model/knjiga.php";

if (isset($_POST['knjigaId'])) {
    $status = Knjiga::deleteById($_POST['knjigaId'], $conn);
    if ($status) {
        echo "Success";
    } else {
        echo $status;
        echo "Failed";
    }
}
