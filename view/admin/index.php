<?php


include("../../auth/authentication.php");
include("../../dB/config.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<section class="container py-5">
    <h2 class="text-center mb-4">Car Listings</h2>
    <div class="row">
        <?php
        // Fetch cars from the database
        $query = "SELECT * FROM cars ORDER BY year DESC";
        $query_run = mysqli_query($conn, $query);

        if (!$query_run) {
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $row) {
        ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                    <img src="<?= !empty($row['image_url']) ? '../../' . $row['image_url'] : '../../uploads/default-car.jpg'; ?>" 
                    class="card-img-top" alt="<?= $row['model']; ?>" 
                    style="height: 200px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="card-title"><?= $row['brand']; ?> <?= $row['model']; ?></h5>
                            <p class="card-text">Year: <?= $row['year']; ?></p>
                            <p class="card-text">Price: $<?= number_format($row['price'], 2); ?></p>
                            <a href="#" class="btn btn-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p class='text-center'>No cars available.</p>";
        }
        ?>
    </div>
</section>

<?php
include("./includes/footer.php");
?>
