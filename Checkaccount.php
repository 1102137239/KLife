<?php

$acc = $_GET['acc'];
require('Config.php');
try {
    $con = new PDO($dsn, $db_user, $db_pass);
    $sql = "SELECT COUNT(*) cut
            FROM member_member
            WHERE account='$acc'";
    $stm = $con->query($sql);
    foreach ($stm as $row) {
        $result = array(
            "data" => $row['cut']
        );
    }
} catch (Exception $exc) {
    $result = array(
        "massage" => $exc->getTraceAsString()
    );
}
echo json_encode($result);
