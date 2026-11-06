<?php
include "koneksi.php";

	if(isset($_POST['update']))
	{
    $info_status=$_REQUEST['info_status'];
    $nomer_seal=$_REQUEST["nomer_seal"];
    $nomer_container=$_REQUEST['nomer_container'];
    $tempat_depo=$_REQUEST['tempat_depo'];
    $tanggal_depo=$_REQUEST['tanggal_depo'];
    $keadaan_seal=$_REQUEST['keadaan_seal'];
    $sql="UPDATE deposit_container set tempat_depo = '$tempat_depo', tanggal_depo = '$tanggal_depo' , keadaan_seal = '$keadaan_seal' where nomer_seal ='$nomer_seal';";
    mysqli_query($koneksi,$sql);
    mysqli_close($koneksi);
    header("Location:penyimpanan_container.php");
	} 
	else  if(isset($_GET['nomer_seal']))
	{
		$nomer_seal= $_GET['nomer_seal'];
		$sql="select * from deposit_container where nomer_seal = '$nomer_seal'";
        $hasil=mysqli_query($koneksi,$sql);		
		if(mysqli_num_rows($hasil)>0)
		{
	    $kolom=mysqli_fetch_assoc($hasil);
        $info_status=$kolom["info_status"];
        $nomer_seal=$kolom["nomer_seal"];
        $nomer_container=$kolom["nomer_container"];
        $tempat_depo=$kolom["tempat_depo"];
        $tanggal_depo=$kolom["tanggal_depo"];
        $keadaan_seal=$kolom["keadaan_seal"];		
		}
	}else if(isset($_POST['shipping'])){
    $info_status="Shipping";
    $nomer_seal=$_REQUEST['nomer_seal'];
    $nomer_container=$_REQUEST['nomer_container'];
    $tempat_depo=$_REQUEST['tempat_depo'];
    $tanggal_depo=$_REQUEST['tanggal_depo'];
    $keadaan_seal=$_REQUEST['keadaan_seal'];
    $sql="INSERT INTO data_shipping VALUES('$info_status','$nomer_seal','$nomer_container','','','','')";
    $sql1="UPDATE deposit_container set info_status = '$info_status' Where nomer_seal = '$nomer_seal' ";
    $sql2="UPDATE tracking set info_status = '$info_status' Where nomer_seal = '$nomer_seal' ";
    mysqli_query($koneksi,$sql);
    mysqli_query($koneksi,$sql1);
    mysqli_query($koneksi,$sql2);
    mysqli_close($koneksi);
    header("Location:penyimpanan_container.php");
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
        <h1>Ubah Data Penyimpanan Container</h1>
        <br>
    <form class="form-horizontal" action="ubah_penyimpanan_container.php" method="POST">
  <div class="form-group">
    <label class="control-label col-sm-2" for="info_status">Info Status:</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="info Status" name="info_status" id="info_status" value="<?php echo $info_status; ?>" required readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="nomer_sea;">Nomor Seal:</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="Nomer Seal" name="nomer_seal" id="nomer_seal" value="<?php echo $nomer_seal; ?>" required readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="nomer_container">Nomor Container:</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="Nomer Container" name="nomer_container" id="nomer_container" value="<?php echo $nomer_container; ?>" required readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tempat_depo">Tempat Penyimpanan :</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="tempat Depo" name="tempat_depo" id="tempat_depo" value="<?php echo $tempat_depo; ?>"  required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tanggal_depo;">Tanggal Penyimpanan:</label>
    <div class="col-sm-10">
    <input type="date" class="form-control" placeholder="Tanggal Depo" name="tanggal_depo" id="tanggal_depo" value="<?php echo $tanggal_depo; ?>"  required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="keadaan_seal">Keadaan Seal:</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="Keadaan Seal" name="keadaan_seal" id="keadaan_seal" value="<?php echo $keadaan_seal; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <button type="submit" name="shipping" class="btn btn-primary"<?php if ($tempat_depo == ''){ ?> disabled <?php } ?>><i class="fa fa-save" style="padding : 0 px"></i> Mulai Shipping</button>
    <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-save" style="padding : 0px"></i> Update</button>
    </div>
  </div>
</form>
    </main>

    <script src="script.js"></script>
  </body>
</html>
