<?php
session_start();

unset( $_SESSION['auth']);
unset( $_SESSION['userRole']);
unset( $_SESSION['authUser']);

$_SESSION['message'] = "Logout successful";
$_SESSION['code'] = "success"; 
header("Location: ../../../login.php");
exit(0);
?>