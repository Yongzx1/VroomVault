<?php
include("../../dB/config.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");

if (isset($_GET['userId'])) {
    $userId = mysqli_real_escape_string($conn, $_GET['userId']);
    $query = "SELECT * FROM users WHERE userId = '$userId'";
    $query_run = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($query_run) > 0) {
        $user = mysqli_fetch_assoc($query_run);
    } else {
        die("User not found.");
    }
} else {
    die("Invalid request.");
}
?>

<div class="pagetitle">
    <h1>Edit User</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../admin/dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Edit User</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit User Details</h5>
                    <form action="update_user.php" method="POST">
                        <input type="hidden" name="userId" value="<?= $user['userId']; ?>">
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" name="firstName" class="form-control" value="<?= $user['firstName']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" name="lastName" class="form-control" value="<?= $user['lastName']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input type="text" name="phoneNumber" class="form-control" value="<?= $user['phoneNumber']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="Male" <?= $user['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?= $user['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" name="birthday" class="form-control" value="<?= $user['birthday']; ?>" required>
                        </div>
                        <button type="submit" name="update_user" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("./includes/footer.php");
?>
