<?php
session_start();
$misid = $_GET['misid'];
require('Config.php');
try {
    $acc = $_SESSION['account'];
    $con = new PDO($dsn, $db_user, $db_pass);
    $sql = "
	SELECT
                `start`,
                `end`,
                `licenseplate`
        FROM
                mission_driverpost MD JOIN member_car MC ON MD.usecar=MC.carno
        WHERE
                misid = $misid
	";
    $stm = $con->query($sql);
    foreach ($stm as $row) {
        $result = array(
            "start" => $row['start'],
            "end" => $row['end'],
            "licenseplate" => $row['licenseplate']
        );
    }
    echo json_encode($result);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

