<?php
session_start();
include("../../dB/config.php"); // Database connection

if (isset($_GET['userId'])) {
    $userId = mysqli_real_escape_string($conn, $_GET['userId']);

    // Check if user exists
    $check_query = "SELECT * FROM users WHERE userId = '$userId'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Delete user
        $delete_query = "DELETE FROM users WHERE userId = '$userId'";
        $delete_result = mysqli_query($conn, $delete_query);

        if ($delete_result) {
            $_SESSION['message'] = "User deleted successfully!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Error deleting user. Please try again.";
            $_SESSION['message_type'] = "danger";
        }
    } else {
        $_SESSION['message'] = "User not found.";
        $_SESSION['message_type'] = "warning";
    }

    // Redirect back to users list
    header("Location: users.php");
    exit();
} else {
    $_SESSION['message'] = "Invalid request.";
    $_SESSION['message_type'] = "warning";
    header("Location: users.php");
    exit();
}
?>
