<?php
session_start();
$Strplace = $_GET['Strplace'];
$Endplace = $_GET['Endplace'];
$date = $_GET['date'];
$Stime = $_GET['Stime'];
$Etime = $_GET['Etime'];
$table=$_GET['table'];
require('Config.php');
try {
    $acc = $_SESSION['account'];
    $con = new PDO($dsn, $db_user, $db_pass);
    $ST = $date . "^" . $Stime;
    $ET = $date . "^" . $Etime;
    $sql = "
	SELECT
                misdetid,start,end,datetime,name
        FROM
                mission_".$table."schedule MDS JOIN mission_".$table."post MD ON MDS.misid=MD.misid JOIN member_member MM ON MD.".$table."=MM.memid
        WHERE
        start='$Strplace' AND end='$Endplace' AND datetime >= '$ST' AND datetime <= '$ET'
	";
    $stm = $con->query($sql);
    foreach ($stm as $row) {
        $result = array(
            "misdetid" => $row['misdetid'],
            "start" => $row['start'],
            "datetime" => $row['datetime'],
            "name" => $row['name'],
            "end" => $row['end']
        );
    }
    if (isset($result)) {
        echo json_encode($result);
    } else {
        $result = array(
            "misdetid" => "Z"
        );
        echo json_encode($result);
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}