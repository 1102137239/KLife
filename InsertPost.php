<?php

session_start();
$table = $_GET['table'];
$acc = $_SESSION['account'];
//mission_driverpost
//mission_passengerpost
$jsonString = file_get_contents("php://input");
$data = json_decode($jsonString);
require('Config.php');
try {
    $con = new PDO($dsn, $db_user, $db_pass);
    $sql = "
            INSERT INTO mission_driverpost (
            `driver`,
            `start`,
            `end`,
            `usecar`
            )
            VALUES(
                    (SELECT memid FROM member_member WHERE account='$acc'),
                    '$data->Strplace',
                    '$data->Endplace',
                    (SELECT carno FROM member_car WHERE licenseplate='$data->licenseplate')
            )
            ";
    $stm = $con->query($sql);
    if ($stm) {
        $result = array(
            "massage" => $con->lastInsertId()
        );
    }
} catch (Exception $exc) {
    $result = array(
        "massage" => $exc->getTraceAsString()
    );
}
echo json_encode($result);
