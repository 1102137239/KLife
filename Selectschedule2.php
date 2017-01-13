<?php
session_start();
$jsonString = file_get_contents("php://input");
$data = json_decode($jsonString);
require('Config.php');
try {
    $acc = $_SESSION['account'];
    $con = new PDO($dsn, $db_user, $db_pass);    
    $sql = "INSERT INTO mission_deliverydetail
                (`misid`, `delegate`, `massage`)
                VALUES
                ('$data->misid',(SELECT memid FROM member_member WHERE account='$acc'), '$data->massage')";
    $stm = $con->query($sql);
    if ($stm) {
        $result = array(
            "misdetid" => "S"
        );
    } else {
        $result = array(
            "misdetid" => "F"
        );
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
echo json_encode($result);