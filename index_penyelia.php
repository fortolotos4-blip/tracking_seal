<?php
include "koneksi.php";

$totalSeal = mysqli_num_rows(
    mysqli_query($koneksi, "SELECT * FROM data_seal")
);

$totalContainer = mysqli_num_rows(
    mysqli_query($koneksi, "SELECT * FROM data_container")
);

$totalShipping = mysqli_num_rows(
    mysqli_query($koneksi,
    "SELECT * FROM data_shipping WHERE posisi='awal'")
);

$totalSelesai = mysqli_num_rows(
    mysqli_query($koneksi,
    "SELECT * FROM data_shipping WHERE posisi='akhir'")
);
?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Index</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
  .dashboard-title{
    text-align:center;
    margin:20px 0 40px;
    font-size:42px;
    font-weight:bold;
}

.dashboard-cards{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:20px;
}

.dashboard-card{
    flex:1 1 250px;
    max-width:280px;
}

</style>  
</head>
  <body>
    <nav class="sidebar">
      <a href="#" class="logo">Hartini Putra</a>

      <div class="menu-content">
        <ul class="menu-items">
          <div class="menu-title"><a href="index_penyelia.php">Dashboard</a></div>

          <li class="item">
            <div class="submenu-item">
              <span>Monitoring</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>

            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
              </div>
              <li class="item">
                <a href="monitoring_seal_penyelia.php">Seal</a>
              </li>
              <li class="item">
                <a href="monitoring_container_penyelia.php">Container</a>
              </li>
            </ul>

            <li class="item">
            <a href="logout.php">Keluar</a>
          </li>
          
          </li>
        </ul>
      </div>
    </nav>

    <nav class="navbar">
      <i class="fa-solid fa-bars" id="sidebar-close"></i>
    </nav>

<main class="main">

<div class="container-fluid">

    <h1 class="dashboard-title">
        Dashboard Penyelia
    </h1>

    <div class="dashboard-cards">

        <div class="dashboard-card">
            <div class="panel panel-primary">
                <div class="panel-heading">Total Seal</div>
                <div class="panel-body text-center">
                    <h2><?php echo $totalSeal; ?></h2>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="panel panel-success">
                <div class="panel-heading">Total Container</div>
                <div class="panel-body text-center">
                    <h2><?php echo $totalContainer; ?></h2>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="panel panel-warning">
                <div class="panel-heading">Sedang Shipping</div>
                <div class="panel-body text-center">
                    <h2><?php echo $totalShipping; ?></h2>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="panel panel-danger">
                <div class="panel-heading">Sampai Tujuan</div>
                <div class="panel-body text-center">
                    <h2><?php echo $totalSelesai; ?></h2>
                </div>
            </div>
        </div>

    </div>

</div>

</main>

    <script src="script.js"></script>
  </body>
</html>
