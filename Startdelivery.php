<?php

session_start();
$acc = $_SESSION['account'];
//mission_driverpost
//mission_passengerpost
$jsonString = file_get_contents("php://input");
$data = json_decode($jsonString);
require('Config.php');
try {
    $con = new PDO($dsn, $db_user, $db_pass);
    $sql = "
            INSERT INTO mission_delivery (
            `driver`,
            `message`,
            `status`
            )
            VALUES(
                    (SELECT memid FROM member_member WHERE account='$acc'),
                    '$data->message',
                    '1'
            )
            ";
    $stm = $con->query($sql);
    if ($stm) {
        $result = array(
            "id" => $con->lastInsertId(),
            "massage" => "OK"
        );
    }
} catch (Exception $exc) {
    $result = array(
        "massage" => $exc->getTraceAsString()
    );
}
echo json_encode($result);
