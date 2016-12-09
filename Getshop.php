<?php
require('Config.php');
try {
    $con = new PDO($dsn, $db_user, $db_pass);
    $stm = $con->query("
	SELECT stid,name
        FROM store_store
	");
    foreach ($stm as $row) {
        $result [] = array(
            "shopid" => $row['stid'],
            "shopname" => $row['name']
        );
    }
    echo json_encode($result);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

