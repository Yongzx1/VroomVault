<?php
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT `userId`, `firstName`,`lastName`,`phoneNumber`,`gender`,`birthday` FROM `users`";
                            $query_run = mysqli_query($conn, $query);
                            if (!$query_run) {
                                die("Query failed: " . mysqli_error($conn));
                            }
                            if (mysqli_num_rows($query_run) > 0) {
                                $index = 0;
                                foreach ($query_run as $row) {
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
                                            <i class="bi bi-eye" onclick="toggleDetails(<?= $index; ?>)" style="font-size: 1rem; cursor: pointer; transition: 0.3s;" onmouseover="this.style.color='#0d6efd'" onmouseout="this.style.color=''"></i>
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
            let span = document.getElementById(`${element}-${index}`);
            if (span.innerText.includes('****')) {
                span.innerText = span.getAttribute('data-original');
            } else {
                span.setAttribute('data-original', span.innerText);
                span.innerText = '****';
            }
        });
    }
</script>

<?php
include("./includes/footer.php");
?>
