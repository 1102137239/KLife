<?php
require('Config.php');
try {
    $con = new PDO($dsn, $db_user, $db_pass);
    $stm = $con->query("
	SELECT bid,name
        FROM car_brand
	");
    foreach ($stm as $row) {
        $result []= array(
            "bid" => $row['bid'],
            "name" => $row['name']
        );
        
    }
    echo json_encode($result);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

