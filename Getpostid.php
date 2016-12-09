<?php
session_start();
$table=$_GET['table'];
require('Config.php');
try {
    $acc = $_SESSION['account'];
    $con = new PDO($dsn, $db_user, $db_pass);
    $sql="
	SELECT misid
        FROM $table
        WHERE driver=(SELECT memid FROM member_member WHERE account='$acc')
	";
    $stm = $con->query($sql);
    foreach ($stm as $row) {
        $result []= array(
            "misid" => $row['misid']
        );
        
    }
    echo json_encode($result);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

