<?php
session_start();
include("../../../dB/config.php");

// Check if `id` is set in the URL
if (isset($_GET['id'])) {
    $carId = $_GET['id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM `cars` WHERE carId = ?");
    $stmt->bind_param("i", $carId);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Car deleted successfully!";
        $_SESSION['code'] = "success"; // For SweetAlert notification
    } else {
        $_SESSION['message'] = "Failed to delete car!";
        $_SESSION['code'] = "error";
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the cars listing page
    header("Location: ../cars.php");
    exit();
} else {
    $_SESSION['message'] = "Invalid request!";
    $_SESSION['code'] = "error";
    header("Location: ../cars.php");
    exit();
}
?>
