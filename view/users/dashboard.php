<?php
ob_start(); // Start output buffering (optional, helps prevent output-related issues)
session_start(); // Start the session

include("../../dB/config.php");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$available_cars = $sold_cars = $reserved_cars = 0; // Ensure variables are initialized

// Query for available cars
$query_available = "SELECT COUNT(*) AS available_cars FROM cars WHERE availability = 'available'";
$result_available = mysqli_query($conn, $query_available);
if ($result_available) {
    $row = mysqli_fetch_assoc($result_available);
    $available_cars = $row['available_cars'];
}

// Query for sold cars
$query_sold = "SELECT COUNT(*) AS sold_cars FROM cars WHERE availability = 'sold'";
$result_sold = mysqli_query($conn, $query_sold);
if ($result_sold) {
    $row = mysqli_fetch_assoc($result_sold);
    $sold_cars = $row['sold_cars'];
}

// Query for reserved cars
$query_reserved = "SELECT COUNT(*) AS reserved_cars FROM cars WHERE availability = 'reserved'";
$result_reserved = mysqli_query($conn, $query_reserved);
if ($result_reserved) {
    $row = mysqli_fetch_assoc($result_reserved);
    $reserved_cars = $row['reserved_cars'];
}

include("../../auth/authenticationForUser.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<!-- Cards Row -->
<div class="row">
   <!-- Available Cars Card -->
<div class="col-lg-4">
    <div class="card bg-success text-white mb-4 shadow"> <!-- Changed to Green -->
        <div class="card-body">
            <h4 class="card-title">Available Cars</h4>
            <p class="card-text" style="font-size: 1.5rem; font-weight: bold;">
                <?= number_format($available_cars) ?> Cars Available
            </p>
        </div>
    </div>
</div>

<!-- Sold Cars Card -->
<div class="col-lg-4">
    <div class="card bg-danger text-white mb-4 shadow"> <!-- Changed to Red -->
        <div class="card-body">
            <h4 class="card-title">Sold Cars</h4>
            <p class="card-text" style="font-size: 1.5rem; font-weight: bold;">
                <?= number_format($sold_cars) ?> Cars Sold
            </p>
        </div>
    </div>
</div>

<!-- Reserved Cars Card -->
<div class="col-lg-4">
    <div class="card bg-warning text-dark mb-4 shadow"> <!-- Kept as Orange -->
        <div class="card-body">
            <h4 class="card-title">Reserved Cars</h4>
            <p class="card-text" style="font-size: 1.5rem; font-weight: bold;">
                <?= number_format($reserved_cars) ?> Cars Reserved
            </p>
        </div>
    </div>
</div>
<!-- End Cards Row -->

<p>Car Listings Overview. Explore the available cars in our inventory.</p>

    <section class="section">
      <div class="row">

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Line Chart</h5>

                <!-- Line Chart -->
                <div id="lineChart"></div>

                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#lineChart"), {
                      series: [{
                        name: "Cars Listed",
                        data: [5, 12, 18, 25, 30, 22, 15, 35, 40, 50, 55, 60] // Example data
                      }],
                      chart: {
                        height: 350,
                        type: 'line',
                        zoom: {
                          enabled: false
                        }
                      },
                      title: {
                        text: "Car Listings Over Time",
                        align: "center"
                      },
                      dataLabels: {
                        enabled: false
                      },
                      stroke: {
                        curve: 'smooth'
                      },
                      grid: {
                        row: {
                          colors: ['#f3f3f3', 'transparent'],
                          opacity: 0.5
                        },
                      },
                      xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                      }
                    }).render();
                  });
                </script>
                <!-- End Line Chart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Area Chart</h5>

                  <!-- Area Chart -->
                  <div id="areaChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      const carSalesData = {
                        sales: [
                          5, 8, 12, 15, 10, 18, 20, 25, 30, 28, 35, 40, 38, 42, 50, 48, 52, 55, 60, 65
                        ],
                        dates: [
                          "01 Feb 2025", "02 Feb 2025", "03 Feb 2025", "04 Feb 2025", "05 Feb 2025",
                          "06 Feb 2025", "07 Feb 2025", "08 Feb 2025", "09 Feb 2025", "10 Feb 2025",
                          "11 Feb 2025", "12 Feb 2025", "13 Feb 2025", "14 Feb 2025", "15 Feb 2025",
                          "16 Feb 2025", "17 Feb 2025", "18 Feb 2025", "19 Feb 2025", "20 Feb 2025"
                        ]
                      };

                      new ApexCharts(document.querySelector("#areaChart"), {
                        series: [{
                          name: "Cars Sold",
                          data: carSalesData.sales
                        }],
                        chart: {
                          type: 'area',
                          height: 350,
                          zoom: {
                            enabled: false
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth'
                        },
                        title: {
                          text: "Car Sales Over Time",
                          align: 'center'
                        },
                        subtitle: {
                          text: 'Tracking daily car sales',
                          align: 'left'
                        },
                        labels: carSalesData.dates,
                        xaxis: {
                          type: 'datetime',
                        },
                        yaxis: {
                          opposite: true,
                          title: {
                            text: "Number of Cars Sold"
                          }
                        },
                        legend: {
                          horizontalAlign: 'left'
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Area Chart -->



            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Column Chart</h5>

              <!-- Column Chart -->
              <div id="columnChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#columnChart"), {
                    series: [{
                      name: 'Sedans',
                      data: [120, 150, 180, 160, 200, 220, 190, 210, 230]
                    }, {
                      name: 'SUVs',
                      data: [180, 200, 250, 230, 270, 290, 260, 300, 320]
                    }, {
                      name: 'Trucks',
                      data: [100, 130, 140, 120, 150, 170, 160, 180, 190]
                    }],
                    chart: {
                      type: 'bar',
                      height: 350
                    },
                    plotOptions: {
                      bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                      },
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      show: true,
                      width: 2,
                      colors: ['transparent']
                    },
                    title: {
                      text: "Car Sales Performance",
                      align: 'center'
                    },
                    subtitle: {
                      text: 'Monthly sales of different car types',
                      align: 'left'
                    },
                    xaxis: {
                      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    },
                    yaxis: {
                      title: {
                        text: 'Number of Cars Sold'
                      }
                    },
                    fill: {
                      opacity: 1
                    },
                    tooltip: {
                      y: {
                        formatter: function(val) {
                          return val + " Cars"
                        }
                      }
                    }
                  }).render();
                });
              </script>
              <!-- End Column Chart -->


            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Bar Chart</h5>

                <!-- Bar Chart -->
                <div id="barChart"></div>

                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#barChart"), {
                      series: [{
                        name: 'Number of Listings',
                        data: [150, 180, 200, 220, 250, 280, 300, 350, 400, 450]
                      }],
                      chart: {
                        type: 'bar',
                        height: 350
                      },
                      plotOptions: {
                        bar: {
                          borderRadius: 4,
                          horizontal: true,
                        }
                      },
                      dataLabels: {
                        enabled: false
                      },
                      title: {
                        text: "Top 10 Car Brands Listed",
                        align: 'center'
                      },
                      xaxis: {
                        categories: ['Mazda', 'Hyundai', 'Nissan', 'Subaru', 'Chevrolet', 'BMW', 'Ford', 'Toyota', 'Honda', 'Mercedes-Benz'],
                      },
                      yaxis: {
                        title: {
                          text: 'Car Brands'
                        }
                      }
                    }).render();
                  });
                </script>
                <!-- End Bar Chart -->




      </div>
    </section>

  </main><!-- End #main -->

 

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/vendor/quill/quill.js"></script>
  <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>





<?php
include("./includes/footer.php");
?>