<?php
include("../../dB/config.php");
include("../../auth/authentication.php");
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
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Cars</h5>
                        <a href="addCars.php" class="btn btn-primary">Add New Car</a>
                    </div>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>Price</th>
                                <th>Availability</th>
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

                                            <?php if ($user_role === 'admin') { ?>
                                                <!-- Edit Icon -->
                                                <i class="bi bi-pencil-square edit-availability-icon" style="font-size: 1.2rem; color: #007bff; cursor: pointer; margin-left: 10px;"
                                                    data-car-id="<?= $row['carId']; ?>" 
                                                    data-availability="<?= $row['availability']; ?>"></i>
                                            <?php } ?>
                                        </td>
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

<!-- Edit Availability Modal -->
<div class="modal fade" id="editAvailabilityModal" tabindex="-1" aria-labelledby="editAvailabilityLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editAvailabilityLabel">Change Availability</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="modalCarId">
        <select id="modalAvailability" class="form-select">
          <option value="available">Available</option>
          <option value="sold">Sold</option>
          <option value="reserved">Reserved</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="saveAvailability">Save</button>
      </div>
    </div>
  </div>
</div>

<?php include("./includes/footer.php"); ?>

<!-- AJAX Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    var carId = 0;

    // Open modal when clicking the edit icon
    $(".edit-availability-icon").click(function() {
        carId = $(this).data("car-id");
        var currentAvailability = $(this).data("availability");

        $("#modalCarId").val(carId);
        $("#modalAvailability").val(currentAvailability);
        $("#editAvailabilityModal").modal("show");
    });

    // Save updated availability
    $("#saveAvailability").click(function() {
        var newAvailability = $("#modalAvailability").val();

        $.ajax({
            url: "./controller/updateAvailability.php",
            type: "POST",
            data: { carId: carId, availability: newAvailability },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Updated!",
                        text: "Car availability has been updated.",
                        timer: 2000,
                        showConfirmButton: false
                    });

                    var badgeColor = {
                        "available": "#28a745",
                        "sold": "#dc3545",
                        "reserved": "#ff9800"
                    }[newAvailability] || "#6c757d";

                    $("span[data-car-id='" + carId + "']")
                        .text(newAvailability.charAt(0).toUpperCase() + newAvailability.slice(1))
                        .css("background-color", badgeColor);

                    $("#editAvailabilityModal").modal("hide");
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: response.message
                    });
                }
            }
        });
    });
});
</script>

</body>
</html>
