<?php

session_start();
include("../db/config.php");

if(isset($_POST['register'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phoneNumber = $_POST['phoneNumber'];
    $role = "user"; // Default role for new users
    $verification = 0; // Default unverified status

    // Check if email already exists
    $check_email_query = "SELECT * FROM `users` WHERE email = '$email' LIMIT 1;";
    $check_email_query_run = mysqli_query($conn, $check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0){
        $_SESSION['message'] = "Email already exists!";
        $_SESSION['code'] = "error";
        header("Location: ../register.php");
        exit();
    }

    // Insert new user
    $register_query = "INSERT INTO `users` (`firstName`, `lastName`, `email`, `password`, `phoneNumber`, `verification`, `role`) 
                        VALUES ('$firstName', '$lastName', '$email', '$password', '$phoneNumber', '$verification', '$role');";

    $register_query_run = mysqli_query($conn, $register_query);

    if($register_query_run){
        $_SESSION['message'] = "Registration successful! You can now login.";
        $_SESSION['code'] = "success";
        header("Location: ../login.php");
        exit();
    }else{
        $_SESSION['message'] = "Registration failed! Please try again.";
        $_SESSION['code'] = "error";
        header("Location: ../registration.php");
        exit();
    }

}else {
    $_SESSION['message'] = "Something went wrong!";
    $_SESSION['code'] = "error";
    header("Location: ../registration.php");
    exit();
}

?>