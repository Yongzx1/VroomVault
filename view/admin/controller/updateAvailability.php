<?php
session_start();
include("../../dB/config.php"); // Adjust the path if needed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $carId = $_POST['carId'];
    $newAvailability = $_POST['availability'];

    // Validate input
    $validStatuses = ['available', 'sold', 'reserved'];
    if (!in_array(strtolower($newAvailability), $validStatuses)) {
        echo json_encode(['success' => false, 'message' => 'Invalid availability status.']);
        exit;
    }

    // Update the database
    $query = "UPDATE cars SET availability = ? WHERE carId = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $newAvailability, $carId);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database update failed.']);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
    