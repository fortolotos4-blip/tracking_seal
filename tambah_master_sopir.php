<?php
include "koneksi.php";
if(isset($_POST['save']))
{
  $nama_sopir=$_REQUEST['nama_sopir'];
  $nomer_telepon=$_REQUEST['nomer_telepon'];
  $status=$_REQUEST['status'];

  // untuk menentukan lokasi data yang telah di input di dalam data seal, monitoring seal dan data stock gudang.
  $sql="INSERT INTO data_sopir VALUES('$nama_sopir','$nomer_telepon','$status');";
  
  // untuk mengirimkan data yang telah di input
  mysqli_query($koneksi,$sql);
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
    <title>Tambah Data</title>
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
        <h1>Tambah Data Master Sopir</h1>
        <br>
    <form class="form-horizontal" action="tambah_master_sopir.php" method="POST">
  <div class="form-group">
    <label class="control-label col-sm-2" for="nama_sopir">Nama Sopir :</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="nama" name="nama_sopir" id="nama_sopir" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="nomer_telepon">Nomor Telepon:</label>
    <div class="col-sm-10">
    <input type="number" class="form-control" placeholder="+62" name="nomer_telepon" id="nomer_telepon" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="status">Status :</label>
    <div class="col-sm-10">
          <Select name="status" id="status" style="padding-right : 87%">
            <option></option>
            <option value="Tetap">Tetap</option>
            <option value="Sewa">Sewa</option>
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
