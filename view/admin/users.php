<?php
ob_start(); // Start output buffering (optional, helps prevent output-related issues)
session_start(); // Start the session

include("../../dB/config.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="pagetitle">
    <h1>User Tables</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../admin/dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th data-type="date" data-format="YYYY/DD/MM">Birthday</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT userId, firstName, lastName, phoneNumber, gender, birthday, role FROM users";
                            $query_run = mysqli_query($conn, $query);
                            if (!$query_run) {
                                die("Query failed: " . mysqli_error($conn));
                            }
                            if (mysqli_num_rows($query_run) > 0) {
                                $index = 0;
                                foreach ($query_run as $row) {
                                    // Assign badge color based on role
                                    $roleBadgeClass = ($row['role'] === 'admin') ? 'bg-danger' : 'bg-info';
                                    ?>
                                    <tr>
                                        <td>
                                            <span class="user-detail" id="name-<?= $index; ?>">
                                                <?= $row['firstName']; ?> <?= $row['lastName']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="user-detail" id="phone-<?= $index; ?>">
                                                <?= $row['phoneNumber']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="user-detail" id="gender-<?= $index; ?>">
                                                <?= $row['gender']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="user-detail" id="birthday-<?= $index; ?>">
                                                <?= $row['birthday']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge <?= $roleBadgeClass; ?>">
                                                <?= ucfirst($row['role']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <i class="bi bi-eye" onclick="toggleDetails(<?= $index; ?>)" style="font-size: 1.5rem; cursor: pointer; transition: 0.3s;" onmouseover="this.style.color='#0d6efd'" onmouseout="this.style.color=''"></i>
                                            
                                            <a href="edit_user.php?userId=<?= $row['userId']; ?>">
                                                <i class="bi bi-pencil-square" style="font-size: 1.5rem; color: green; cursor: pointer; transition: 0.3s;" onmouseover="this.style.color='darkgreen'" onmouseout="this.style.color='green'"></i>
                                            </a>
                                            
                                            <a href="#" onclick="confirmDelete(<?= $row['userId']; ?>)">
    <i class="bi bi-trash3" style="font-size: 1.5rem; color: red; cursor: pointer; transition: 0.3s;" onmouseover="this.style.color='darkred'" onmouseout="this.style.color='red'"></i>
</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $index++;
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

<script>
    function toggleDetails(index) {
        let elements = ['name', 'phone', 'gender', 'birthday'];
        
        elements.forEach(element => {
            let span = document.getElementById(${element}-${index});
            if (span.innerText.includes('****')) {
                span.innerText = span.getAttribute('data-original');
            } else {
                span.setAttribute('data-original', span.innerText);
                span.innerText = '****';
            }
        });
    }
</script>

<script>
function confirmDelete(userId) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `delete_user.php?userId=${userId}`;
        }
    });
}
</script>

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



<?php
include("./includes/footer.php");
?>