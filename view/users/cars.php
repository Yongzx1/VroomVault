<?php
include("../../dB/config.php");
include("../../auth/authenticationForUser.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");

$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user'; // Default to 'user'

?>

<div class="pagetitle">
    <h1>Inventory</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../admin/dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Inventory</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-0">Cars</h5>
                    
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>Price</th>
                                <th>Availability</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM cars";
                            $query_run = mysqli_query($conn, $query);

                            if (!$query_run) {
                                die("Query failed: " . mysqli_error($conn));
                            }

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                                    // Check if image exists, else use default
                                    $image_path = (!empty($row['image_url']) && file_exists("../../" . $row['image_url'])) ? "../../" . $row['image_url'] : "../../uploads/default-car.jpg";

                                    // Assign distinct colors based on availability status
                                    $availability_colors = [
                                        'available' => '#28a745',  // Green
                                        'sold' => '#dc3545',       // Red
                                        'reserved' => '#ff9800'    // Orange
                                    ];
                                    $badge_color = $availability_colors[$row['availability']] ?? '#6c757d'; // Default Gray
                            ?>
                                    <tr>
                                        <td><?= $row['brand']; ?></td>
                                        <td><?= $row['model']; ?></td>
                                        <td><?= $row['year']; ?></td>
                                        <td>$<?= number_format($row['price'], 2); ?></td>
                                        <td>
                                            <span class="badge availability-badge" data-car-id="<?= $row['carId']; ?>" 
                                                style="background-color: <?= $badge_color; ?>; color: white; padding: 5px 10px; border-radius: 5px;">
                                                <?= ucfirst($row['availability']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <img src="<?= $image_path; ?>" class="card-img-top" alt="<?= $row['model']; ?>" 
                                                style="height: 200px; width: 300px; object-fit: cover;">
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("./includes/footer.php"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
