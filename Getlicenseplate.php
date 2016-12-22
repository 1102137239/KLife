<?php
session_start();
require('Config.php');
if (isset($_SESSION['account'])) {
    try {
        $con = new PDO($dsn, $db_user, $db_pass);
        $acc = $_SESSION['account'];
        $sql = "
	SELECT licenseplate
        FROM member_car
        WHERE `owner`=(SELECT memid FROM member_member WHERE `account`='$acc')
	";
        $stm = $con->query($sql);
        foreach ($stm as $row) {
            $result [] = array(
                "licenseplate" => $row['licenseplate']
            );
        }
    } catch (Exception $exc) {
        $result [] = array(
            "licenseplate" => $exc->getTraceAsString()
        );
    }
} else {
    $result [] = array(
        "licenseplate" => '你沒有車'
    );
}
echo json_encode($result);


