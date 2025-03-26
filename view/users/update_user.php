<?php
include("../../dB/config.php");
session_start();

if (isset($_POST['update_user'])) {
    $userId = mysqli_real_escape_string($conn, $_POST['userId']);
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    
    $query = "UPDATE users SET firstName='$firstName', lastName='$lastName', phoneNumber='$phoneNumber', gender='$gender', birthday='$birthday' WHERE userId='$userId'";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "User updated successfully!";
        $_SESSION['code'] = "success";
    } else {
        $_SESSION['message'] = "Error updating user: " . mysqli_error($conn);
        $_SESSION['code'] = "error";
    }
    
    header("Location: users.php");
    exit();
} else {
    $_SESSION['message'] = "Invalid request.";
    $_SESSION['code'] = "error";
    header("Location: users.php");
    exit();
}
