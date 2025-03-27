<?php
session_start();
include("../../../dB/config.php");

if (isset($_POST['add_car'])) {
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // File upload handling
    $target_dir = "../../../uploads/";
    $default_image = "uploads/default-car.jpg"; // Relative to the project root
    $image_url = $default_image; // Default to default image

    if (!empty($_FILES["carImage"]["name"])) {
        $image_name = basename($_FILES["carImage"]["name"]);
        $image_path = $target_dir . $image_name;
        $image_file_type = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));

        // Validate file type (only allow JPG, JPEG, PNG, GIF)
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($image_file_type, $allowed_types)) {
            $_SESSION['message'] = "Invalid file type! Only JPG, JPEG, PNG, and GIF allowed.";
            $_SESSION['message_type'] = "error"; // Changed from 'code' to 'message_type'
            header("Location: ../addCars.php");
            exit();
        }

        // Move file to uploads directory
        if (move_uploaded_file($_FILES["carImage"]["tmp_name"], $image_path)) {
            $image_url = "uploads/" . $image_name; // Store relative path for database
        } else {
            $_SESSION['message'] = "Failed to upload image!";
            $_SESSION['message_type'] = "error"; // Changed from 'code' to 'message_type'
            header("Location: ../addCars.php");
            exit();
        }
    }

    // Insert car details into database
    $query = "INSERT INTO `cars` (brand, model, year, price, description, image_url) 
              VALUES ('$brand', '$model', '$year', '$price', '$description', '$image_url')";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Car added successfully!";
        $_SESSION['message_type'] = "success"; // Changed from 'code' to 'message_type'
        header("Location: ../cars.php");
        exit();
    } else {
        $_SESSION['message'] = "Failed to add car!";
        $_SESSION['message_type'] = "error"; // Changed from 'code' to 'message_type'
        header("Location: ../addCars.php");
        exit();
    }
}
?>
