<?php

session_start();
include("../db/config.php");

if(isset($_POST['login'])){
$email = $_POST['email'];
$password = $_POST['password'];

$login_query = "SELECT `userId`, `firstName`, `lastName`, `email`, `password`, `phoneNumber`, `verification`, `role` FROM `users` WHERE email = '$email' AND password = '$password' LIMIT 1;";

$login_query_run = mysqli_query($conn,$login_query);

if($login_query_run){

    if(mysqli_num_rows($login_query_run) > 0){
        $data = mysqli_fetch_assoc($login_query_run);

        $userId = $data['userId'];
        $fullName = $data['firstName'] . ' ' . $data['lastName'];
        $emailAddress = $data['email'];
        $verification = $data['verification'];
        $userRole = $data['role'];

        $_SESSION['auth'] = true;
        $_SESSION['userRole'] = $userRole;
        $_SESSION['authUser'] = [
            'userId' => $userId,
            'fullName' => $fullName,
            'emailAddress' => $emailAddress,
        ];

        if($userRole == 'admin'){
            $_SESSION['message'] = "You are now logged in as ADMIN.";
            $_SESSION['code'] = "success";
            header('Location: ../view/admin/index.php');
            exit();
        } else if($userRole == 'user'){
            $_SESSION['message'] = "You are now logged in as USER.";
            $_SESSION['code'] = "success";
            header('Location: ../view/users/index.php'); // Move exit() after this line
            exit();
        } else {
            header('Location: ../login.php');
            exit();
        }
        

    }else {
        $_SESSION['message'] = "Invalid Email Address or Password";
        $_SESSION['code'] = "error";
        header("Location: ../login.php");
    }

}else{
    $_SESSION['message'] = "There's something wrong in the code!";
    $_SESSION['code'] = "error";
    header("Location: ../login.php");
}
}else {
    $_SESSION['message'] = "There's something wrong in the code!";
    $_SESSION['code'] = "error";
    header("Location: ../login.php");
}

?>