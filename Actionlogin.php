<?php

$account = $_POST['account'];
$password = $_POST['password'];
$refer = $_POST['refer'];


if ($account == '' || $password == '') {
    echo "<script>alert('帳號密碼空白');</script>";
    header('Refresh: 0; Login.php?refer=' . urlencode($_POST['refer']));
    exit;
} else {
    require('Config.php');
    try {
        $con = new PDO($dsn, $db_user, $db_pass);
        $stm = $con->query("SELECT `account`,`password` FROM `member_member` WHERE `account` = '$account' AND `Password` = password('$password')");
        $count = 0;
        foreach ($stm as $row) {
            $count++;
        }
        if ($count > 1) {
            echo "<script>alert('請勿嘗試攻擊');</script>";
            header('Refresh: 0;  Login.php?refer=' . urlencode($refer));
            exit;
        } else if ($count == 1) {
            session_start();
            $_SESSION['account'] = $row['account'];
            if (empty($refer) || !$refer) {
                $refer = 'index.html';
            }
            header('Location: ' . $refer);
        } else {
            echo "<script>alert('系統錯誤，請稍後在試');</script>";
            header('Refresh: 0;  Login.php?refer=' . urlencode($refer));
            exit;
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
