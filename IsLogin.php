<?php

session_start();
if (isset($_SESSION['account'])) {
    $result = array(
        "islogin" => true,
        "account" => $_SESSION['account']
    );
    echo json_encode($result);
} else {
    $result = array(
        "islogin" => false,
        "account" => "Guest"
    );
    echo json_encode($result);
}


