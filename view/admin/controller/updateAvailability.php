<?php
include("../../dB/config.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['carId'], $_POST['availability'])) {
    $carId = mysqli_real_escape_string($conn, $_POST['carId']);
    $availability = mysqli_real_escape_string($conn, $_POST['availability']);

    // Validate availability options
    $allowed_statuses = ['available', 'sold', 'reserved'];
    if (!in_array($availability, $allowed_statuses)) {
        echo json_encode(["success" => false, "message" => "Invalid availability status."]);
        exit();
    }

    // Update query
    $query = "UPDATE cars SET availability='$availability' WHERE carId='$carId'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Car availability updated successfully!";
        $_SESSION['code'] = "success";
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error updating availability: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}
?>
