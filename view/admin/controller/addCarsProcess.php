<?php
session_start();
include("../../../dB/config.php");


if (isset($_POST['add_car'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    // Insert car details without image
    $query = "INSERT INTO `cars` (brand, model, year, price, description) VALUES ('$brand', '$model', '$year', '$price', '$description')";
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>