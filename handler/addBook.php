<?php

require "../dbBroker.php";
require "../model/knjiga.php";

if (isset($_POST['naslov']) && isset($_POST["autor"]) && isset($_POST["godinaNastanka"]) && isset($_POST["cena"])) {
    $status = Knjiga::add($_POST['naslov'], $_POST["autor"], $_POST["godinaNastanka"], $_POST["cena"], $conn);
    if ($status) {
        $last_id = $conn->insert_id;
        echo "Success ";
        echo $last_id;
    } else {
        echo $status;
        echo "Failed";
    }
}

?>