<?php
include("../../dB/config.php");

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $carId = isset($_POST['carId']) ? intval($_POST['carId']) : 0;
    $availability = isset($_POST['availability']) ? $_POST['availability'] : '';

    if ($carId > 0 && !empty($availability)) {
        $query = "UPDATE cars SET availability = ? WHERE carId = ?";
        $stmt = mysqli_prepare($conn, $query);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $availability, $carId);
            if (mysqli_stmt_execute($stmt)) {
                echo json_encode(["success" => true]);
                exit;
            } else {
                echo json_encode(["success" => false, "message" => "Database update failed."]);
                exit;
            }
        } else {
            echo json_encode(["success" => false, "message" => "Query preparation failed."]);
            exit;
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid input."]);
        exit;
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
    exit;
}

mysqli_close($conn);
?>
