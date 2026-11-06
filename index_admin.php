<?php
include "koneksi.php";

$totalSeal = mysqli_num_rows(
    mysqli_query($koneksi,
    "SELECT * FROM data_seal")
);

$totalContainer = mysqli_num_rows(
    mysqli_query($koneksi,
    "SELECT * FROM data_container")
);

$totalShipping = mysqli_num_rows(
    mysqli_query($koneksi,
    "SELECT * FROM data_shipping
     WHERE posisi='awal'")
);

$totalSelesai = mysqli_num_rows(
    mysqli_query($koneksi,
    "SELECT * FROM data_shipping
     WHERE posisi='akhir'")
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
.dashboard-wrapper{
    width:100%;
    max-width:100%;
    padding-left:15px;
    padding-right:15px;
}

.dashboard-cards{
    display:flex;
    flex-wrap:wrap;
    gap:20px;
    justify-content:center;
}

.dashboard-card{
    flex:1 1 250px;
    max-width:280px;
}

.row{
    margin-left:0;
    margin-right:0;
}

.table{
    table-layout:fixed;
    width:100%;
}

.table td,
.table th{
    word-wrap:break-word;
}
.table th:nth-child(4),
.table td:nth-child(4){
    width:35%;
}
.panel{
    width:100%;
}
.panel-body{
    overflow-x:auto;
}
.dashboard-title{
    text-align:center;
    margin:20px 0 40px;
    font-size:48px;
    font-weight:700;
}
</style>
</head>
  <body>
    <nav class="sidebar">
      <a href="#" class="logo">Hartini Putra</a>

      <div class="menu-content">
        <ul class="menu-items">
          <div class="menu-title"><a href="index_admin.php">Dashboard</a></div>

          <li class="item">
            <div class="submenu-item">
              <span>Pencatatan</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>

            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
              </div>
              <li class="item">
                <a href="master_seal.php">Master Seal</a>
              </li>
              <li class="item">
                <a href="master_container.php">Master Container</a>
              </li>
              <li class="item">
                <a href="master_sopir.php">Master Sopir</a>
              </li>
              <li class="item">
                <a href="penyimpanan_container.php">Penyimpanan area Container</a>
              </li>
              <li class="item">
                <a href="shipping.php">Shipping</a>
              </li>
            </ul>
          </li>

          <li class="item">
            <a href="tracking.php">Tracking</a>
          </li>

          <li class="item">
            <a href="logout.php">Keluar</a>
          </li>
          
        </ul>
      </div>
    </nav>

    <nav class="navbar">
      <i class="fa-solid fa-bars" id="sidebar-close"></i>
    </nav>

    <main class="main">

<div class="container-fluid dashboard-wrapper">

    <h1 class="dashboard-title">
    Dashboard Monitoring Seal
</h1>

    <div class="dashboard-cards">

    <div class="dashboard-card">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Total Seal
                </div>

                <div class="panel-body text-center">
                    <h2><?php echo $totalSeal; ?></h2>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Total Container
                </div>

                <div class="panel-body text-center">
                    <h2><?php echo $totalContainer; ?></h2>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    Sedang Shipping
                </div>

                <div class="panel-body text-center">
                    <h2><?php echo $totalShipping; ?></h2>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Sampai Tujuan
                </div>

                <div class="panel-body text-center">
                    <h2><?php echo $totalSelesai; ?></h2>
                </div>
            </div>
        </div>

    </div>

    <hr>

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <strong>10 Data Shipping Terbaru</strong>
                </div>

                <div class="panel-body">

                    <table class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Seal</th>
                                <th>Nomor Container</th>
                                <th>Lokasi Saat Ini</th>
                                <th>Keadaan Seal</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php

                        $no = 1;

                        $query = mysqli_query(
                            $koneksi,
                            "SELECT *
                             FROM data_shipping
                             ORDER BY tanggal_shipping DESC
                             LIMIT 10"
                        );

                        while($row = mysqli_fetch_assoc($query))
                        {
                        ?>

                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['nomer_seal']; ?></td>
                                <td><?php echo $row['nomer_container']; ?></td>
                                <td><?php echo $row['lokasi_sekarang']; ?></td>
                                <td><?php echo $row['keadaan_seal']; ?></td>
                            </tr>

                        <?php
                        }
                        ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

</main>

    <script src="script.js"></script>
  </body>
</html>
