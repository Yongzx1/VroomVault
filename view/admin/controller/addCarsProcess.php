<?php
session_start();
include("../../../dB/config.php");


if (isset($_POST['add_car'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    
    // Insert car details without image
    $query = "INSERT INTO `cars` (brand, model, year, price) VALUES ('$brand', '$model', '$year', '$price')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Car added successfully!";
        $_SESSION['code'] = "success";  // 
        header("Location: ../cars.php");
        exit();
    } else {
        $_SESSION['message'] = "Failed to add car!";
        $_SESSION['code'] = "error";  // 
    }
}

?>