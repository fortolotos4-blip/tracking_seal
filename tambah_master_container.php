<?php
include "koneksi.php";
if(isset($_POST['save']))
{
  $nomer_container=$_REQUEST['nomer_container'];
	$jenis_container=$_REQUEST['jenis_container'];
	$label=$_REQUEST['label'];
	$sql="INSERT INTO data_container VALUES('$nomer_container','$jenis_container','$label');";
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
        <h1>Tambah Data Master Container</h1>
        <br>
    <form class="form-horizontal" action="tambah_master_container.php" method="POST">
  <div class="form-group">
    <label class="control-label col-sm-2" for="nomer_container">Nomor Container:</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="Nomor Container" name="nomer_container" id="nomer_container" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="jenis_container">Jenis Container:</label>
    <div class="col-sm-10">
          <select name="jenis_container" id="jenis_container" style="padding-right : 87%" required>
          <option value=""></option>
            <option value="20 FEET STD">20 FEET STD</option>
            <option value="20 FEET + TRIPLEK">20 FEET TRIPLEK</option>
            <option value="21 FEET STD">21 FEET STD</option>
            <option value="40 FEET HIGHCUBE">40 FEET HIGHCUBE</option>
            <option value="FLEXI BAG">FLEXI BAG</option>
            <option value="ISOTANK">ISOTANK</option>
        </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tempat_penyimpanan">Tempat Penyimpanan:</label>
    <div class="col-sm-10">
    <select name="label" id="label" style="padding-right : 87%" required>
    <option value=""></option>
            <option value="MERATUS">MERATUS</option>
            <option value="SPIL">SPIL</option>
            <option value="ICON">ICON</option>
            <option value="THEMAS SBY">THEMAS SBY</option>
          </select>
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
