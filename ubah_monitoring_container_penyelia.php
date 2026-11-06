<?php
include "koneksi.php";

	if(isset($_POST['update']))
	{
    $nomer_seal=$_REQUEST["nomer_seal"];
    $nomer_container=$_REQUEST['nomer_container'];
    $pabrik=$_REQUEST['pabrik'];
    $jenis_barang=$_REQUEST['jenis_barang'];
    $tgl_stuffing=$_REQUEST['tgl_stuffing'];
    $no_pol=$_REQUEST['no_pol'];
    $sql="UPDATE monitoring_container set pabrik = '$pabrik', tgl_stuffing = '$tgl_stuffing' where nomer_seal ='$nomer_seal'";
    mysqli_query($koneksi,$sql);
    mysqli_close($koneksi);
    header("Location:monitoring_container_penyelia.php");
	} 
	else  if(isset($_GET['nomer_seal']))
	{
		$nomer_seal= $_GET['nomer_seal'];
		$sql="select * from monitoring_container where nomer_seal = '$nomer_seal'";
        $hasil=mysqli_query($koneksi,$sql);		
		if(mysqli_num_rows($hasil)>0)
		{
	    $kolom=mysqli_fetch_assoc($hasil);
      $nomer_seal=$kolom["nomer_seal"];
      $nomer_container=$kolom["nomer_container"];
      $pabrik=$kolom["pabrik"];
      $jenis_barang=$kolom["jenis_barang"];		
      $tgl_stuffing=$kolom["tgl_stuffing"];
      $no_pol=$kolom["no_pol"];
		}
	}else if(isset($_POST['depo'])){
    $info_status="Depo";
    $nomer_container=$_REQUEST['nomer_container'];
    $nomer_seal=$_REQUEST['nomer_seal'];
    $pabrik=$_REQUEST['pabrik'];
    $jenis_barang=$_REQUEST['jenis_barang'];
    $tgl_stuffing=$_REQUEST['tgl_stuffing'];
    $sql="INSERT INTO deposit_container VALUES('$info_status','$nomer_seal','$nomer_container','','','')";
    $sql1="INSERT INTO tracking VALUES('$info_status','$nomer_seal','$nomer_container')";
    mysqli_query($koneksi,$sql);
    mysqli_query($koneksi,$sql1);
    mysqli_close($koneksi);
    header("Location:monitoring_container_penyelia.php");
  }
	

?>

<!DOCTYPE html>
<!-- YouTube or Website - CodingLab -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Monitoring Container</title>
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
        <h1>Ubah Data Monitoring Container</h1>
        <br>
    <form class="form-horizontal" action="ubah_monitoring_container_penyelia.php" method="POST">
  <div class="form-group">
    <label class="control-label col-sm-2" for="nomer_seal">Nomor Seal:</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="Nomer Seal" name="nomer_seal" id="nomer_seal" value="<?php echo $nomer_seal; ?>" required readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="nomer_container">Nomor Container:</label>
    <div class="col-sm-10"><input type="input" class="form-control" placeholder="Nomer Container" name="nomer_container" id="nomer_container" value="<?php echo $nomer_container; ?>" required readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pabrik">Pabrik :</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="Pabrik" name="pabrik" id="pabrik" value="<?php echo $pabrik; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="jenis_barang">Jenis Barang :</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="Jenis Barang" name="jenis_barang" id="jenis_barang" value="<?php echo $jenis_barang; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tgl_stuffing">Tanggal Stuffing :</label>
    <div class="col-sm-10">
    <input type="date" class="form-control" placeholder="Tanggal Stuffing" name="tgl_stuffing" id="tgl_stuffing" value="<?php echo $tgl_stuffing; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="no_pol">Nomor Polisi :</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="Nomor Polisi" name="no_pol" id="no_pol" value="<?php echo $no_pol; ?>" readonly required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <button type="submit" name="depo" class="btn btn-primary"><i class="fa fa-save" style="padding : 0 px;"></i> Mulai Depo</button>
    <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-save" style="padding : 0 px;"></i> Update</button></div>
  </div>
</form>
    </main>

    <script src="script.js"></script>
  </body>
</html>
