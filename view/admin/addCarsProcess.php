<?php
session_start();
include("../../dB/config.php");

if (isset($_POST['add_car'])) {
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']); // New field

    // Default image path
    $default_image = "uploads/default-car.jpg";
    $final_image = $default_image;

    // Image Upload Handling
    $target_dir = "../../uploads/"; // Ensure this folder exists

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
    }

    if (!empty($_FILES["carImage"]["name"])) {
        $image_name = time() . "_" . basename($_FILES["carImage"]["name"]);
        $target_file = $target_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Allowed file types
        $allowed_types = ["jpg", "jpeg", "png", "gif"];

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["carImage"]["tmp_name"], $target_file)) {
                // Store relative path for DB
                $final_image = "uploads/" . $image_name;  
            } else {
                $_SESSION['message'] = "File upload failed. Check folder permissions.";
                $_SESSION['code'] = "error";
                header("Location: ../cars.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Invalid file type: " . $imageFileType;
            $_SESSION['code'] = "error";
            header("Location: ../cars.php");
            exit();
        }
    }

    // Insert into database
    $query = "INSERT INTO cars (brand, model, year, price, description, image_url) 
          VALUES ('$brand', '$model', '$year', '$price', '$description', '$final_image')";


    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Car added successfully!";
        $_SESSION['code'] = "success";
        header("Location: ../cars.php");
        exit();
    } else {
        $_SESSION['message'] = "Database Error: " . mysqli_error($conn);
        $_SESSION['code'] = "error";
        header("Location: ../cars.php");
        exit();
    }
}
?>
