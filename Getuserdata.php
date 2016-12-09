<?php
session_start();
$account = $_SESSION['account'];

require('Config.php');
try {
	$con = new PDO($dsn, $db_user, $db_pass);
	$stm = $con->query("
	SELECT M.account,M.`name`,M.birthday,C.brand,C.color,C.licenseplate,M.tel
	FROM `member_member` M LEFT JOIN `member_car` C ON M.memid=C.`owner`
	WHERE M.account='$account'
	");
	foreach ($stm as $row) {
		$result = array(
			"account" => $row['account'],
			"name" => $row['name'],
			"birthday" => $row['birthday'],
			"brand" => $row['brand'],
			"color" => $row['color'],
                        "tel" => $row['tel'],
			"licenseplate" => $row['licenseplate']
		);
		echo json_encode($result);		
	}
} catch (Exception $exc) {
	echo $exc->getTraceAsString();
}

