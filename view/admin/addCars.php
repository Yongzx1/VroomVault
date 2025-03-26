<?php
include("../../auth/authentication.php");
include("../../dB/config.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<form action="./controller/addCarsProcess.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="brand" class="form-label"><strong>Brand</strong></label>
        <input type="text" class="form-control" name="brand" placeholder="Enter car brand (e.g., Toyota)" required>
    </div>
    <div class="mb-3">
        <label for="model" class="form-label"><strong>Model</strong></label>
        <input type="text" class="form-control" name="model" placeholder="Enter car model (e.g., Corolla)" required>
    </div>
    <div class="mb-3">
        <label for="year" class="form-label"><strong>Year</strong></label>
        <input type="number" class="form-control" name="year" placeholder="Enter manufacturing year (e.g., 2022)" required>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label"><strong>Price</strong></label>
        <input type="number" class="form-control" name="price" placeholder="Enter price (e.g., 20000)" required>
    </div>

    <div class="mb-S3">
        <label for="description" class="form-label"><strong>Description</strong></label>
        <textarea class="form-control" name="description" rows="4" placeholder="Enter car description" required></textarea>

    </div>

    <div class="mb-3">
        <label for="carImage" class="form-label"><strong>Car Image</strong></label>
        <input type="file" class="form-control" name="carImage" accept="image/*" required>
    </div>
    <button type="submit" name="add_car" class="btn btn-primary">Add Car</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
  if (!empty($_SESSION['message']) && !empty($_SESSION['message_type'])) {
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
          icon: "<?= htmlspecialchars($_SESSION['message_type']); ?>",
          title: "<?= htmlspecialchars($_SESSION['message']); ?>"
        });
      </script>
<?php
      unset($_SESSION['message']);
      unset($_SESSION['code']);
  }
?>
