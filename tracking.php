<!DOCTYPE html>
<!-- YouTube or Website - CodingLab -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tracking</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Datatable-->
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  </head>
  <body>
    <nav class="sidebar">
      <a href="#" class="logo">Hartini Putra</a>

      <div class="menu-content">
        <ul class="menu-items">
          <div class="menu-title">Dashboard</div>

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
    <div class="col-sm-9">
      <div class="grid-test">
      </div>
      <br>
      <table class="tabel-data">
    <thead>
    <tr>
        <th>No</th>
        <th>Info Status</th>
        <th>Nomer Seal</th>
        <th>Nomer Container</th>
        <th>Port Tujuan</th>
        <th>No Pol</th>
        <th>Sopir</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
        <!-- Source code untuk melakukan Pencarian data (Search Data) -->
        <?php
        if(isset($_GET['cari'])){
            $cari = $_GET['cari'];
        }
        ?>
        <!-- Source code untuk menampilkan Data dari database -->
        <?php
        include "koneksi.php";
        $nomer = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM data_shipping");
        //Digunakan untuk melakukan filter search yang di input
        if(isset($_GET['cari'])){
            $cari = $_GET['cari'];
            $query = mysqli_query($koneksi,"SELECT * FROM monitoring_container WHERE no_seal LIKE '%".$cari."%'");
        }else{
            $query = mysqli_query($koneksi,"SELECT tracking.info_status, tracking.nomer_seal, tracking.nomer_container,monitoring_seal.tujuan, monitoring_container.no_pol, monitoring_seal.sopir
            FROM tracking 
            INNER JOIN monitoring_seal ON tracking.nomer_seal = monitoring_seal.nomer_seal
            INNER JOIN monitoring_container ON tracking.nomer_seal = monitoring_container.nomer_seal ");
        };
        while ($data = mysqli_fetch_array($query)){
          if($data['info_status'] == "Depo"){
            echo "<tr>
          <td>".$nomer."</td>
          <td><a href='deposit_container.php'>".$data['info_status']."</a></td>
          <td>".$data['nomer_seal']."</td>
          <td>".$data['nomer_container']."</td>
          <td>".$data['tujuan']."</td>
          <td>".$data['no_pol']."</td>
          <td>".$data['sopir']."</td>
          <td><a href='ubah_penyimpanan_container.php?nomer_seal=$data[nomer_seal]'>Update</a></td>
          </tr>";

        $nomer++;
          }else if($data['info_status'] == "Shipping"){
            echo "<tr>
          <td>".$nomer."</td>
          <td><a href='shipping.php'>".$data['info_status']."</a></td>
          <td>".$data['nomer_seal']."</td>
          <td>".$data['nomer_container']."</td>
          <td>".$data['tujuan']."</td>
          <td>".$data['no_pol']."</td>
          <td>".$data['sopir']."</td>
          <td><a href='ubah_shipping.php?nomer_seal=$data[nomer_seal]'>Update</a></td>
          </tr>";

        $nomer++;
          }else if($data['info_status'] == "Sampai Tujuan"){
            echo "<tr>
          <td>".$nomer."</td>
          <td><p>".$data['info_status']."</p></td>
          <td>".$data['nomer_seal']."</td>
          <td>".$data['nomer_container']."</td>
          <td>".$data['tujuan']."</td>
          <td>".$data['no_pol']."</td>
          <td>".$data['sopir']."</td>
          </tr>";

        $nomer++;
          }
        // Untuk Search 
        }
      ?>
    </tbody>
    <script>
    $(document).ready(function(){
        $('.tabel-data').DataTable();
    });
</script>
  </table>
    </main>

    <script src="script.js"></script>
  </body>
</html>
