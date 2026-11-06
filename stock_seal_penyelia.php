<!DOCTYPE html>
<!-- YouTube or Website - CodingLab -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Master Seal</title>
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
      </div>
      <br>
      <table class="tabel-data">
    <thead>
        <div style="margin-bottom: 70px;">
        <form class="form-inline" action="" method="get" style="margin-bottom: -5px;">
            <div class="col-sm-3">
                <label for="dari">Dari :</label>
                <input type="date" name="from_date" class="form-control">
            </div>
            <div class="col-sm-3">
                <label for="sampai">Sampai :</label>
                <input type="date" name="to_date" class="form-control">
            </div>
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary" style="padding-bottom : -90px">Cari</button>
            </div>
        </form>
          </div>
        <div style="margin-bottom:100px;">
      <form class="form-inline">
        <div class="col-sm-3">
        <p style="text-transform: capitalize;"> Tanggal : 
        <?php
          error_reporting(0);
          // Koneksi Database
          include "koneksi.php";
          $from_date=$_REQUEST['from_date'];
          $to_date=$_REQUEST['to_date'];
          if($from_date == "" && $to_date == ""){
            echo "$from_date - $to_date";
          }else{
            echo "$from_date - $to_date";
          }
          ?>
        </p>
        </div>
        <div class="col-sm-3">
        <p style="text-transform: capitalize;">Jumlah Belum Terpakai : 
        <?php
        error_reporting(0);
        include "koneksi.php";
        $variabel="Belum Terpakai";
        $from_date=$_REQUEST['from_date'];
        $to_date=$_REQUEST['to_date'];
        $query1 = mysqli_query($koneksi, "SELECT nomer_seal FROM data_stock_seal WHERE seal_status LIKE 'Belum Terpakai' AND tanggal_ambil BETWEEN '$from_date' AND '$to_date' ");
        $jumlah = mysqli_num_rows($query1);
        if($jumlah == ""){
          echo "$jumlah";
        }else{
          echo "$jumlah";
        }
        ?></p>
        </div>
        <div class="col-sm-3">
        <p style="text-transform: capitalize;">Jumlah Terpakai : 
        <?php
        error_reporting(0);
        include "koneksi.php";
        $variabel="Belum Terpakai";
        $from_date=$_REQUEST['from_date'];
        $to_date=$_REQUEST['to_date'];
        $query1 = mysqli_query($koneksi, "SELECT nomer_seal FROM data_stock_seal WHERE seal_status LIKE 'Terpakai' AND tanggal_ambil BETWEEN '$from_date' AND '$to_date' ");
        $jumlah = mysqli_num_rows($query1);
        if($jumlah == ""){
          echo "$jumlah";
        }else{
          echo "$jumlah";
        }
    ?> </p>
        </div>
      </form>
      </div>
    <tr>
        <th>No</th>
        <th>Nomer Seal</th>
        <th>Tempat Penyimpanan</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
        <!-- Source code untuk menampilkan Data dari database -->
        <?php
        include "koneksi.php";
        $nomer = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM data_stock_seal");
        //Digunakan untuk melakukan filter search yang di input
        if(isset($_GET['from_date']) && isset($_GET['to_date'])){
            $from_date = $_GET['from_date'];
            $to_date = $_GET['to_date'];
            $query = mysqli_query($koneksi,"SELECT * FROM data_stock_seal WHERE tanggal_ambil BETWEEN '$from_date' AND '$to_date'");
            
        }else{
            $query = mysqli_query($koneksi,"SELECT * FROM data_stock_seal");
        };
        while ($data = mysqli_fetch_array($query)){
          echo "<tr>
          <td>".$nomer."</td>
          <td>".$data['nomer_seal']."</td>
          <td>".$data['tempat_penyimpanan']."</td>
          <td>".$data['seal_status']."</td>
          </tr>";
          
        $nomer++;
        }
      ?>
    </tbody>
    <script>
    $(document).ready(function(){
        $('.tabel-data').DataTable({
            searching: false
        });
        dom: 'lrtip'
    });
</script>
  </table>
    </main>

    <script src="script.js"></script>
  </body>
</html>
