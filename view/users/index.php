<?php
include("../../auth/authenticationForUser.php");
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
                            <button class="btn btn-primary w-100 viewDetailsBtn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#carDetailsModal"
                                    data-car-id="<?= $row['carId']; ?>">
                                View Details
                            </button>
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

<!-- Car Details Modal -->
<div class="modal fade" id="carDetailsModal" tabindex="-1" aria-labelledby="carDetailsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="carDetailsLabel">Car Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="carDetailsContent">
            <p class="text-center">Loading...</p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("./includes/footer.php"); ?>

<!-- jQuery & Bootstrap Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $(".viewDetailsBtn").click(function() {
        var carId = $(this).data("car-id");

        // Fetch car details via AJAX
        $.ajax({
            url: "getCarDetails.php",
            type: "POST",
            data: { carId: carId },
            success: function(response) {
                $("#carDetailsContent").html(response);
            },
            error: function() {
                $("#carDetailsContent").html("<p class='text-danger text-center'>Failed to load details.</p>");
            }
        });
    });
});
</script>
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
