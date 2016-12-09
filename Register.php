<?php

$jsonString = file_get_contents("php://input");
$data = json_decode($jsonString);
require('Config.php');
try {
    $con = new PDO($dsn, $db_user, $db_pass);
    $sql="INSERT INTO `member_member`
                (`account`, `password`, `name`, `birthday`,`tel`)
                VALUES
                ('$data->acc', password('$data->pw'), '$data->name', '$data->bir', '$data->tel')";
    $stm = $con->query($sql);
    if($stm){
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






