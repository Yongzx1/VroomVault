<?php
ob_start(); // Start output buffering
session_start();
include("../../dB/config.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");

// Ensure user is authenticated
if (!isset($_SESSION['authUser']['userId'])) {
    $_SESSION['message'] = "Unauthorized access!";
    $_SESSION['code'] = "error";
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['authUser']['userId'];

// Securely fetch user details
$query = "SELECT firstName, lastName, email, phoneNumber FROM users WHERE userId = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// Ensure default values to prevent undefined variable errors
$firstName = $user['firstName'] ?? '';
$lastName = $user['lastName'] ?? '';
$email = $user['email'] ?? '';
$phoneNumber = $user['phoneNumber'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phoneNumber = htmlspecialchars(trim($_POST['phoneNumber']));

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format!";
        $_SESSION['code'] = "error";
        header("Location: profile.php");
        exit();
    }

    // Securely update user data
    $updateQuery = "UPDATE users SET firstName = ?, lastName = ?, email = ?, phoneNumber = ? WHERE userId = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ssssi", $firstName, $lastName, $email, $phoneNumber, $userId);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Profile updated successfully!";
        $_SESSION['code'] = "success";
        header("Location: profile.php");
        exit();
    } else {
        $_SESSION['message'] = "Error updating profile: " . mysqli_error($conn);
        $_SESSION['code'] = "error";
    }
}
?>

<style>
body {
    background-color: #fff;
}
</style>

<main style="display: flex; justify-content: center; flex-direction: column; padding: 2em 2em;">
<div class="pagetitle">
  <h1 style="color:#010101;">Edit Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="../admin/dashboard.php">Home</a></li>
      <li class="breadcrumb-item active" style="color:#010101;">Edit Profile</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title" style="color:#010101;">Edit Profile Details</h5>
          <form method="POST">
            <div class="mb-3">
              <label class="form-label">First Name</label>
              <input type="text" name="firstName" class="form-control" value="<?= htmlspecialchars($firstName); ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Last Name</label>
              <input type="text" name="lastName" class="form-control" value="<?= htmlspecialchars($lastName); ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email); ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Phone Number</label>
              <input type="text" name="phoneNumber" class="form-control" value="<?= htmlspecialchars($phoneNumber); ?>">
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: ##4154F1; border: 1px solid ##4154F1;">Update Profile</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if (isset($_SESSION['message']) && $_SESSION['code'] != '') {
    ?>
    <script>
        Swal.fire({
            icon: "<?= $_SESSION['code']; ?>",
            title: "<?= $_SESSION['message']; ?>",
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
    </script>
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['code']);
}
?>
