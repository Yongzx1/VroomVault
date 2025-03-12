<?php
include("../../dB/config.php");
include("../../auth/authenticationForUser.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="pagetitle">
    <h1>Car Listings</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../admin/dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Cars</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
    <h5 class="card-title mb-0">Cars</h5>
    
</div>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>Price</th>
                                <th>Action</th>
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
                    ?>

                            <tr>
                                <td><?= $row['brand']; ?></td>
                                <td><?= $row['model']; ?></td>
                                <td><?= $row['year']; ?></td>
                                <td>$<?= number_format($row['price'], 2); ?></td>
                                <td>
                                    <a href="./controller/deleteCarProcess.php?id=<?= $row['carId']; ?>" onclick="return confirm('Are you sure you want to delete this car?')">
                                        <i class="bi bi-trash3" style="font-size: 1.2rem; color: red; cursor: pointer; transition: 0.3s;" 
                                        onmouseover="this.style.color='darkred'" 
                                        onmouseout="this.style.color='red'"></i>
                                    </a>
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php
if(isset($_SESSION['message']) && $_SESSION['code'] !='') {
    ?>
    <script>
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: "<?php echo $_SESSION['code']; ?>",
        title: "<?php echo $_SESSION['message']; ?>"
      });
    </script>
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['code']);
}     
?>


<?php
include("./includes/footer.php");
?>