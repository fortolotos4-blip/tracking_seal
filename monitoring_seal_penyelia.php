<!DOCTYPE html>
<!-- YouTube or Website - CodingLab -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Monitoring Seal</title>
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
    <div class="col-sm-9">
      <div class="grid-test">
        <div><form style="margin-top: -5px;" class="export_excel" method="POST" action="stock_seal_penyelia.php"><input type="submit" name="export" class="btn btn-primary" value="Stock Seal"></form></div>
      </div>
      <table class="tabel-data">
    <thead>
      <br>
    <tr>
        <th>No</th>
        <th>Nomer Seal</th>
        <th>Tanggal Ambil</th>
        <th>Tanggal pakai</th>
        <th>Tujuan</th>
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
        $query = mysqli_query($koneksi, "SELECT data_seal.nomer_seal, data_seal.tanggal_ambil, monitoring_seal.tanggal_pakai, monitoring_seal.tujuan, monitoring_seal.sopir FROM monitoring_seal INNER JOIN data_seal ON monitoring_seal.nomer_seal = data_seal.nomer_seal");
        //Digunakan untuk melakukan filter search yang di input
        if(isset($_GET['cari'])){
            $cari = $_GET['cari'];
            $query = mysqli_query($koneksi,"SELECT data_seal.nomer_seal, data_seal.tanggal_ambil, monitoring_seal.tanggal_pakai, monitoring_seal.tujuan, monitoring_seal.sopir FROM monitoring_seal INNER JOIN data_seal ON monitoring_seal.nomer_seal = data_seal.nomer_seal WHERE tanggal_ambil LIKE '%".$cari."%' or no_seal LIKE '%".$cari."%' 
            or tanggal_pakai LIKE '%".$cari."%' or tujuan LIKE '%".$cari."%' or sopir LIKE '%".$cari."%' ");
        }else{
            $query = mysqli_query($koneksi,"SELECT data_seal.nomer_seal, data_seal.tanggal_ambil, monitoring_seal.tanggal_pakai, monitoring_seal.tujuan, monitoring_seal.sopir FROM monitoring_seal INNER JOIN data_seal ON monitoring_seal.nomer_seal = data_seal.nomer_seal");
        };
        while ($data = mysqli_fetch_array($query)){
          echo "<tr>
          <td>".$nomer."</td>
          <td>".$data['nomer_seal']."</td>
          <td>".$data['tanggal_ambil']."</td>
          <td>".$data['tanggal_pakai']."</td>
          <td>".$data['tujuan']."</td>
          <td>".$data['sopir']."</td>
          <td><a href='ubah_monitoring_seal_penyelia.php?nomer_seal=$data[nomer_seal]'>Ubah</a></td>
          </tr>";
          
        $nomer++;
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
