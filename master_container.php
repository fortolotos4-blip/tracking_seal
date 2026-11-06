<!DOCTYPE html>
<!-- YouTube or Website - CodingLab -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Master Container</title>
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
        <div><form style="margin-right: 10px;" class="tambah_data_container" method="POST" action="tambah_master_container.php"><input type="submit" class="btn btn-info" value="Tambah Data"></form></div>
        <div><form style="margin-top: 0px;" class="export_excel" method="POST" action="export_container.php"><input type="submit" name="export" class="btn btn-success" value="Export"></form></div>
      </div>
      <br>
      <table class="tabel-data">
    <thead>
    <tr>
        <th>No</th>
        <th>Nomer Container</th>
        <th>Jenis Container</th>
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
        $query = mysqli_query($koneksi, "SELECT * FROM data_container");
        //Digunakan untuk melakukan filter search yang di input
        if(isset($_GET['cari'])){
            $cari = $_GET['cari'];
            $query = mysqli_query($koneksi,"SELECT * FROM data_container WHERE nomer_container LIKE '%".$cari."%' or shipping LIKE '%".$cari."%' 
            or jenis_container LIKE '%".$cari."%'");
        }else{
            $query = mysqli_query($koneksi,"SELECT * FROM data_container");
        };
        while ($data = mysqli_fetch_array($query)){
          echo "<tr>
          <td>".$nomer."</td>
          <td>".$data['nomer_container']."</td>
          <td>".$data['jenis_container']."</td>
          <td><a href='hapus_master_container.php?nomer_container=$data[nomer_container]'><button  class='btn btn-primary' style='font-size:2.5px'><i style='font-size:10px' class='glyphicon glyphicon-remove'></i></button></a></td>
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
