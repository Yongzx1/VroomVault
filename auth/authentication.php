<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include(__DIR__ . '/../dB/config.php');

if(!isset($_SESSION['auth'])){
    $_SESSION['message'] = "Login to access dashboard";
    $_SESSION['code'] = "error";
    header("Location: ../../../login.php");
    exit();
}else{
if($_SESSION['userRole'] != 'admin'){
    $_SESSION['message'] = "You are not authorized as ADMIN";
    $_SESSION['code'] = "error"; 
    header("Location: ../../view/users/index.php");
    exit();
}
}

?>