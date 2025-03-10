<?php
session_start();
include("../../dB/config.php");

if (isset($_POST['add_car'])) {
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    // Default image path
    $default_image = "uploads/default-car.jpg";
    $final_image = $default_image;

    // Image Upload Handling
    $target_dir = "/uploads"; // Ensure this folder exists
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
                $final_image = "uploads/" . $image_name; // Store relative path in DB
            } else {
                die("File upload failed. Check folder permissions.");
            }
        } else {
            die("Invalid file type: " . $imageFileType);
        }
    }

    // Debugging: Check the final image path before inserting into DB
    echo "Final image path: " . $final_image;
    exit();

    // Insert into database
    $query = "INSERT INTO cars (brand, model, year, price, image_url) 
          VALUES ('$brand', '$model', '$year', '$price', '$final_image')";

echo "SQL Query: " . $query; // Debugging step
exit();

if (mysqli_query($conn, $query)) {
    $_SESSION['message'] = "Car added successfully!";
    $_SESSION['code'] = "success";
    header("Location: ../cars.php");
    exit();
} else {
    die("Error inserting into database: " . mysqli_error($conn)); // Show error
}
}


?>
