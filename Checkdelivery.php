<?php
session_start();
require('Config.php');
try {
    $acc = $_SESSION['account'];
    $con = new PDO($dsn, $db_user, $db_pass);
    $sql = "
	SELECT misid,message
        FROM mission_delivery
        WHERE `status`=1 AND driver=(SELECT memid FROM member_member WHERE `account`='$acc')
	";
    $stm = $con->query($sql);
    foreach ($stm as $row) {
        $result = array(
            "misid" => $row['misid'],
            "message" => $row['message']
        );
    }
    echo json_encode($result);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

