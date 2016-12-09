<?php
require('Config.php');
try {
    $con = new PDO($dsn, $db_user, $db_pass);
    $stm = $con->query("
	SELECT plid,name,address
        FROM mission_place
	");
    foreach ($stm as $row) {
        $result [] = array(
            "plid" => $row['plid'],
            "name" => $row['name'],
            "address" => $row['address']
        );
    }
    echo json_encode($result);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

