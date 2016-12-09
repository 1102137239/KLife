<?php

$table = $_GET['table'];
require('Config.php');
try {
    $con = new PDO($dsn, $db_user, $db_pass);
    $sql = "SELECT COUNT(*) cut
            FROM $table";
    $stm = $con->query($sql);
    foreach ($stm as $row) {
        $result = array(
            "qty" => $row['cut']
        );
    }
} catch (Exception $exc) {
    $result = array(
        "massage" => $exc->getTraceAsString()
    );
}
echo json_encode($result);
