<?php
include("../../dB/config.php");

if (isset($_POST['carId'])) {
    $carId = mysqli_real_escape_string($conn, $_POST['carId']);

    $query = "SELECT * FROM cars WHERE carId = '$carId'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);

        // Apply the same availability color logic from cars.php
        $availability_colors = [
            'available' => '#28a745',  // Green
            'sold' => '#dc3545',       // Red
            'reserved' => '#ff9800'    // Orange
        ];
        $badge_color = $availability_colors[$row['availability']] ?? '#6c757d'; // Default Gray
        ?>

        <div class="row">
            <div class="col-md-6">
                <img src="<?= !empty($row['image_url']) ? '../../' . $row['image_url'] : '../../uploads/default-car.jpg'; ?>" 
                     class="img-fluid rounded" alt="<?= $row['model']; ?>">
            </div>
            <div class="col-md-6">
                <h3><?= $row['brand']; ?> <?= $row['model']; ?></h3>
                <p><strong>Year:</strong> <?= $row['year']; ?></p>
                <p><strong>Price:</strong> $<?= number_format($row['price'], 2); ?></p>
                <p><strong>Availability:</strong> 
                    <span class="badge" style="background-color: <?= $badge_color; ?>; color: white; padding: 5px 10px; border-radius: 5px;">
                        <?= ucfirst($row['availability']); ?>
                    </span>
                </p>
                <p><strong>Description:</strong> <?= !empty($row['description']) ? $row['description'] : "No description available."; ?></p>
            </div>
        </div>

        <?php
    } else {
        echo "<p class='text-danger text-center'>Car details not found.</p>";
    }
} else {
    echo "<p class='text-danger text-center'>Invalid request.</p>";
}
?>
