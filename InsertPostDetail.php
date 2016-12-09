<?php

session_start();
$table = $_GET['table'];
$acc = $_SESSION['account'];
//mission_driverschedule
//mission_passengerschedule
$jsonString = file_get_contents("php://input");
$jsonString2 = str_replace('},{', '}<^^^>{', $jsonString);
for ($i = 0; $i < count(explode("<^^^>", $jsonString2)); $i++) {
    $data[] = json_decode(explode("<^^^>", $jsonString2)[$i]);
}
require('Config.php');
try {
    $con = new PDO($dsn, $db_user, $db_pass);
    for ($i = 0; $i < count($data); $i++) {
        $id = $data[$i]->id;
        $datetime = $data[$i]->date . "^" . $data[$i]->time;
        $detail = $data[$i]->detail;
        $sql = "
            INSERT INTO mission_driverschedule (
                    `misid`,
                    `datetime`,
                    `message`
            )
            VALUES
            (
                '$id','$datetime','$detail'
            )
            ";
        $stm = $con->query($sql);
    }
    if ($stm) {
        $result = array(
            "massage" => "success"
        );
    }else{
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
