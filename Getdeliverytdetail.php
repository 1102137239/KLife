<?php
session_start();
require('Config.php');
try {
    $acc = $_SESSION['account'];
    $con = new PDO($dsn, $db_user, $db_pass);
    $sql = "
	SELECT
                `misid`,
                `name`,
                MD.`message`
        FROM
                mission_delivery MD JOIN member_member MM ON MD.driver=MM.memid
        WHERE 
                status = 1
	";
    $stm = $con->query($sql);
    foreach ($stm as $row) {
        $result [] = array(
            "misid" => $row['misid'],
            "name" => $row['name'],
            "message" => $row['message']
        );
    }
    echo json_encode($result);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

