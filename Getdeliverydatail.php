<?php
session_start();
$misid = $_GET['misid'];
require('Config.php');
try {
    $acc = $_SESSION['account'];
    $con = new PDO($dsn, $db_user, $db_pass);
    $sql = "
	SELECT delegate,massage
        FROM mission_deliverydetail
        WHERE
                misid = $misid
	";
    $stm = $con->query($sql);
    foreach ($stm as $row) {
        $result [] = array(
            "delegate" => $row['delegate'],
            "massage" => $row['massage']
        );
    }
    echo json_encode($result);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

