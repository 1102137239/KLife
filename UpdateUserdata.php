<?php

$jsonString = file_get_contents("php://input");
$data = json_decode($jsonString);
require('Config.php');
try {
    $con = new PDO($dsn, $db_user, $db_pass);
    $sql = "UPDATE member_member
            SET birthday='$data->bir',name='$data->name',tel='$data->tel'
            WHERE account='$data->acc'
            ";
    $stm = $con->query($sql);
    if ($stm) {
        if ($data->bra != '') {
            $sql = "SELECT
                        COUNT(carno) cut
                FROM
                        member_car MC
                RIGHT JOIN member_member MM ON MC.`owner` = MM.memid
                WHERE MM.`account` = '$data->acc'";
            $stm = $con->query($sql);
            foreach ($stm as $row) {
                if ($row['cut'] != '0') {
                    $sql = "UPDATE member_car
                        SET brand='$data->bra',color='$data->col',licenseplate='$data->lic'
                        WHERE owner=(SELECT memid FROM member_member WHERE account='$data->acc')";
                    $stm = $con->query($sql);
                    if ($stm) {
                        $result = array(
                            "massage" => "success"
                        );
                    } else {
                        $result = array(
                            "massage" => "fail"
                        );
                    }
                } else {
                    $sql = "INSERT INTO member_car
                    (`brand`, `color`, `licenseplate`, `owner`)
                    VALUES
                    ('$data->bra','$data->col','$data->lic',(SELECT memid FROM member_member WHERE account='$data->acc'))";
                    $stm = $con->query($sql);
                    if ($stm) {
                        $result = array(
                            "massage" => "success"
                        );
                    } else {
                        $result = array(
                            "massage" => "fail"
                        );
                    }
                }
            }
        } else {
            $result = array(
                "massage" => "success"
            );
        }
    } else {
        $result = array(
            "massage" => "fail"
        );
    }
} catch (Exception $exc) {
    $result = array(
        "massage" => $exc->getTraceAsString()
    );
}
echo json_encode($result);