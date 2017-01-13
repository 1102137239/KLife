<?php
session_start();
$misdetid=$_GET['misdetid'];
require('Config.php');
try {
    $acc = $_SESSION['account'];
    $con = new PDO($dsn, $db_user, $db_pass);    
    $sql = "UPDATE mission_driverschedule
            SET passenger=(SELECT memid FROM member_member WHERE account='$acc')
            WHERE misdetid=$misdetid";
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