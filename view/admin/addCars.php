<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>



<form action="./controller/addCarsProcess.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="brand" class="form-label">Brand</label>
        <input type="text" class="form-control" name="brand" required>
    </div>
    <div class="mb-3">
        <label for="model" class="form-label">Model</label>
        <input type="text" class="form-control" name="model" required>
    </div>
    <div class="mb-3">
        <label for="year" class="form-label">Year</label>
        <input type="number" class="form-control" name="year" required>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="text" class="form-control" name="price" required>
    </div>
    <div class="mb-3">
        <label for="carImage" class="form-label">Car Image</label>
        <input type="file" class="form-control" name="carImage" accept="image/*" required>
    </div>
    <button type="submit" name="add_car" class="btn btn-primary">Add Car</button>
</form>



<?php include("./includes/footer.php"); ?>
