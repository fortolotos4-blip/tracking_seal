<?php
include "koneksi.php";
if(isset($_POST['save']))
{
  // $Status mutlak untuk memperjelas kondisi Seal di awal pengambilan.
  $seal_status="Belum Terpakai";

  $nomer_seal=$_REQUEST['nomer_seal'];
  $tanggal_ambil=$_REQUEST['tanggal_ambil'];
  $tempat_penyimpanan=$_REQUEST['tempat_penyimpanan'];

  // untuk menentukan lokasi data yang telah di input di dalam data seal, monitoring seal dan data stock gudang.
  $sql="INSERT INTO data_seal VALUES('$nomer_seal','$tanggal_ambil','$tempat_penyimpanan');";
  $sql1="INSERT INTO monitoring_seal VALUES('$nomer_seal','','','');";
  $sql2="INSERT INTO data_stock_seal VALUES ('$nomer_seal','$tanggal_ambil','$tempat_penyimpanan','','$seal_status');";
  
  // untuk mengirimkan data yang telah di input
  mysqli_query($koneksi,$sql);
  mysqli_query($koneksi,$sql1);
  mysqli_query($koneksi,$sql2);
  mysqli_close($koneksi);
}
?>

<!DOCTYPE html>
<!-- YouTube or Website - CodingLab -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Monitoring Seal</title>
    <link rel="stylesheet" href="style1.css" />
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
        <h1>Tambah Data Master Seal</h1>
        <br>
    <form class="form-horizontal" action="tambah_master_seal.php" method="POST">
  <div class="form-group">
    <label class="control-label col-sm-2" for="nomer_seal">Nomor Seal:</label>
    <div class="col-sm-10">
      <input type="input" class="form-control" placeholder="Nomor Seal" name="nomer_seal" id="nomer_seal" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tanggal_ambil">Tanggal Ambil:</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" placeholder="yy-mm-dd" name="tanggal_ambil" id="tanggal_ambil" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tempat_penyimpanan">Tempat Penyimpanan:</label>
    <div class="col-sm-10">
    <Select name="tempat_penyimpanan" id="tempat_penyimpanan" style="padding-right : 87%">
            <option></option>
            <option value="Gudang 1">Gudang 1</option>
            <option value="Gudang 2">Gudang 2</option>
            <option value="Gudang 3">Gudang 3</option>
          </Select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <button type="submit" name="save" class="btn btn-primary" style="padding : 0 px;"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>
</form>
    </main>

    <script src="script.js"></script>
  </body>
</html>
