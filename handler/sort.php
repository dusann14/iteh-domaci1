<?php

require "../dbBroker.php";
require "../model/knjiga.php";

$result = Knjiga::sortTable($conn);

if ($result) {
    while ($red = $result->fetch_array()) {
        echo json_encode($red);
    }
} else {
    echo "Failed";
}
