<?php
session_start();
$misid = $_GET['misid'];
require('Config.php');
try {
    $acc = $_SESSION['account'];
    $con = new PDO($dsn, $db_user, $db_pass);
    $sql = "
	SELECT
                `datetime`,
                `message`
        FROM
                mission_driverschedule
        WHERE
                misid = $misid
	";
    $stm = $con->query($sql);
    foreach ($stm as $row) {
        $result [] = array(
            "date" => explode("^", $row['datetime'])[0],
            "time" => explode("^", $row['datetime'])[1],
            "detail" => $row['message']
        );
    }    
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
echo json_encode($result);
