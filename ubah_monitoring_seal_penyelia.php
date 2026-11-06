<?php
include "koneksi.php";

	if(isset($_POST['update']))
	{
  $seal_status = "Terpakai";
	$nomer_seal=$_REQUEST['nomer_seal'];
	$tanggal_ambil=$_REQUEST['tanggal_ambil'];
	$tanggal_pakai=$_REQUEST['tanggal_pakai'];
	$tujuan=$_REQUEST['tujuan'];
  $sopir=$_REQUEST['sopir'];
	$sql="UPDATE monitoring_seal set tanggal_pakai = '$tanggal_pakai', tujuan = '$tujuan', sopir = '$sopir' where nomer_seal ='$nomer_seal';";
  // Update tambahan dengan persyaratan
  if(empty($tanggal_pakai)){

  }else{
    $sql2="UPDATE data_stock_seal set tanggal_pakai = '$tanggal_pakai', seal_status = '$seal_status' where nomer_seal = '$nomer_seal'";
    mysqli_query($koneksi,$sql2);
  }
	mysqli_query($koneksi,$sql);
	mysqli_close($koneksi);
	header("Location:monitoring_seal_penyelia.php");
	} 
	else  if(isset($_GET['nomer_seal']))
	{
		$nomer_seal= $_GET['nomer_seal'];
		$sql="SELECT monitoring_seal.nomer_seal, data_seal.tanggal_ambil, monitoring_seal.tanggal_pakai, monitoring_seal.tujuan, monitoring_seal.sopir FROM monitoring_seal INNER JOIN data_seal ON monitoring_seal.nomer_seal = data_seal.nomer_seal WHERE monitoring_seal.nomer_seal = '$nomer_seal'";
        $hasil=mysqli_query($koneksi,$sql);		
		if(mysqli_num_rows($hasil)>0)
		{
	    $kolom=mysqli_fetch_assoc($hasil);
	    $nomer_seal=$kolom["nomer_seal"];
		$tanggal_ambil=$kolom["tanggal_ambil"];
        $tanggal_pakai=$kolom["tanggal_pakai"];
		$tujuan=$kolom["tujuan"];
		$sopir=$kolom["sopir"];
		}
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
        <h1>Ubah Data Monitoring Seal</h1>
        <br>
    <form class="form-horizontal" action="ubah_monitoring_seal_penyelia.php" method="POST">
  <div class="form-group">
    <label class="control-label col-sm-2" for="nomer_seal">Nomor Seal:</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="Nomer Seal" name="nomer_seal" id="nomer_seal" value="<?php echo $nomer_seal; ?>" required readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tanggal_ambil">Tanggal Ambil:</label>
    <div class="col-sm-10">
    <input type="date" class="form-control" placeholder="dd/mm/yy" name="tanggal_ambil" id="tanggal_ambil" value="<?php echo $tanggal_ambil; ?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tanggal_pakai">Tanggal Pakai:</label>
    <div class="col-sm-10">
    <input type="date" class="form-control" placeholder="yy-mm-dd" name="tanggal_pakai" id="tanggal_pakai" value="<?php echo $tanggal_pakai; ?>"  required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tujuan">Tujuan :</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="Tempat" name="tujuan" id="tujuan" value="<?php echo $tujuan; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tujuan">Sopir :</label>
    <div class="col-sm-10">
    <select name="sopir" id="sopir" style="padding-right : 87%" required>
    <option disabled selected></option>
    <?php
    include "koneksi.php";
    $sql = mysqli_query($koneksi,"SELECT nama_sopir FROM data_sopir");
    while($data = mysqli_fetch_array($sql)){
      ?><option value="<?php echo $data['nama_sopir']; ?>"><?php echo $data['nama_sopir']; ?></option>
      <?php
      }
      ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-save" style="padding : 0 px;"></i> Update</button>
    </div>
  </div>
</form>
    </main>

    <script src="script.js"></script>
  </body>
</html>
