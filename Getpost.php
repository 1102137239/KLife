<?php

$table = $_GET['table'];
$start = $_GET['start'];
$qty = $_GET['qty'];
require('Config.php');
try {
    $con = new PDO($dsn, $db_user, $db_pass);
    $sql="";
    if($table!="mission_driverpost"){
        $sql = "SELECT  `misid` ,  `name` ,  `start` ,  `end` ,  MD.`message` 
                FROM  `$table` MD
                JOIN  `member_member` MM ON MD.`passenger` = MM.memid
                LIMIT $start , $qty";
    }else{
        $sql = "SELECT  `misid` ,  `name` ,  `start` ,  `end` ,  MD.`message` 
                FROM  `$table` MD
                JOIN  `member_member` MM ON MD.`driver` = MM.memid
                LIMIT $start , $qty";
    }
    $stm = $con->query($sql);
    foreach ($stm as $row) {
        $result[] = array(
            "misid" => $row['misid'],
            "name" => $row['name'],
            "start" => $row['start'],
            "end" => $row['end'],
            "message" => $row['message']
        );
    }
} catch (Exception $exc) {
    $result = array(
        "massage" => $exc->getTraceAsString()
    );
}
echo json_encode($result);
