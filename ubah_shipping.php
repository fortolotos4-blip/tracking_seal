<?php
include "koneksi.php";

	if(isset($_POST['update']))
	{
    $provinsi=$_REQUEST["provinsi"];
    $kota=$_REQUEST["kota"];
    $nomer_seal=$_REQUEST["nomer_seal"];
    $nomer_container=$_REQUEST['nomer_container'];
    $tanggal_shipping=$_REQUEST['tanggal_shipping'];
    $lokasi_sekarang="$provinsi, $kota";
    $keadaan_seal=$_REQUEST['keadaan_seal'];
    $sql="UPDATE data_shipping set lokasi_sekarang = '$lokasi_sekarang',tanggal_shipping = '$tanggal_shipping', keadaan_seal = '$keadaan_seal' where nomer_seal ='$nomer_seal'";
    mysqli_query($koneksi,$sql);
    mysqli_close($koneksi);
    header("Location:shipping.php");
	} 
	else  if(isset($_GET['nomer_seal']))
	{
		$nomer_seal= $_GET['nomer_seal'];
		$sql="select * from data_shipping where nomer_seal = '$nomer_seal'";
        $hasil=mysqli_query($koneksi,$sql);		
		if(mysqli_num_rows($hasil)>0)
		{
	    $kolom=mysqli_fetch_assoc($hasil);
      $nomer_seal=$kolom["nomer_seal"];
      $nomer_container=$kolom["nomer_container"];
      $tanggal_shipping=$kolom["tanggal_shipping"];
      $lokasi_sekarang=$kolom["lokasi_sekarang"];
      $keadaan_seal=$kolom["keadaan_seal"];
      $posisi=$kolom["posisi"];
		}
	}else if(isset($_POST['simpan'])){
    $posisi="awal";
    $provinsi=$_REQUEST['provinsi'];
    $kota=$_REQUEST['kota'];
    $nomer_seal=$_REQUEST['nomer_seal'];
    $nomer_container=$_REQUEST['nomer_container'];
    $tanggal_shipping=$_REQUEST['tanggal_shipping'];
    $tanggal_shipping_awal = "$tanggal_shipping";
    $lokasi_sekarang="$provinsi, $kota";
    $lokasi_awal = $lokasi_sekarang;
    $keadaan_seal=$_REQUEST['keadaan_seal'];
    $sql="INSERT INTO perjalanan_awal VALUES('$nomer_seal','$nomer_container','$tanggal_shipping_awal','$lokasi_awal','$keadaan_seal')";
    $sql1="UPDATE data_shipping set lokasi_sekarang = '$lokasi_sekarang',tanggal_shipping = '$tanggal_shipping', keadaan_seal = '$keadaan_seal',posisi = '$posisi' where nomer_seal ='$nomer_seal'";
    mysqli_query($koneksi,$sql);
    mysqli_query($koneksi,$sql1);
    mysqli_close($koneksi);
    header("Location:shipping.php");
  }else if(isset($_POST['selesai'])){
    $info_status="Sampai Tujuan";
    $posisi="akhir";
    $provinsi=$_REQUEST['provinsi'];
    $kota=$_REQUEST['kota'];
    $nomer_seal=$_REQUEST['nomer_seal'];
    $nomer_container=$_REQUEST['nomer_container'];
    $tanggal_shipping=$_REQUEST['tanggal_shipping'];
    $tanggal_shipping_akhir = "$tanggal_shipping";
    $lokasi_sekarang="$provinsi, $kota";
    $lokasi_terakhir=$lokasi_sekarang;
    $keadaan_seal=$_REQUEST['keadaan_seal'];
    $sql="INSERT INTO perjalanan_akhir VALUES('$nomer_seal','$nomer_container','$tanggal_shipping_akhir','$lokasi_terakhir','$keadaan_seal')";
    $sql1="UPDATE data_shipping set lokasi_sekarang = '$lokasi_sekarang',tanggal_shipping = '$tanggal_shipping', keadaan_seal = '$keadaan_seal',posisi = '$posisi',info_status = '$info_status' where nomer_seal ='$nomer_seal'";
    $sql2="UPDATE tracking set info_status = '$info_status' Where nomer_seal = '$nomer_seal' ";
    mysqli_query($koneksi,$sql);
    mysqli_query($koneksi,$sql1);
    mysqli_query($koneksi,$sql2);
    mysqli_close($koneksi);
    header("Location:shipping.php");
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
        <h1>Ubah Data Shipping</h1>
        <br>
    <form class="form-horizontal" action="ubah_shipping.php" method="POST">
  <div class="form-group">
    <label class="control-label col-sm-2" for="nomer_seal">Nomor Seal:</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="Nomer Seal" name="nomer_seal" id="nomer_seal" value="<?php echo $nomer_seal; ?>" required readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="nomer_container;">Nomor Container:</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="Nomer Container" name="nomer_container" id="nomer_container" value="<?php echo $nomer_container; ?>" required readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tanggal_shipping">Tanggal Shipping:</label>
    <div class="col-sm-10">
    <input type="date" class="form-control" placeholder="tanggal_shipping" name="tanggal_shipping" id="tanggal_shipping" value="<?php echo $tanggal_shipping; ?>" required>
    </div>
  </div>
 <div class="form-group">
    <label class="control-label col-sm-2">Provinsi</label>
    <div class="col-sm-10">
        <select class="form-control" name="provinsi" id="provinsi" required>
            <option value="">Pilih Provinsi</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-sm-2">Kota / Kabupaten</label>
    <div class="col-sm-10">
        <select class="form-control" name="kota" id="kota" required>
            <option value="">Pilih Kota / Kabupaten</option>
        </select>
    </div>
</div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="keadaan_seal">Keadaan Seal:</label>
    <div class="col-sm-10">
    <input type="input" class="form-control" placeholder="Keadaan Seal" name="keadaan_seal" id="keadaan_seal" value="<?php echo $keadaan_seal; ?>" required>
    </div>
  </div>
  <button type="submit" name="simpan" class="btn btn-primary"<?php if ($posisi == 'awal' ){ ?> disabled <?php } ?>><i class="fa fa-save" style="padding : 0 px"></i> Simpan</button>
<button type="submit" name="update" class="btn btn-primary"<?php if ($posisi == '' ){ ?> disabled <?php } ?>><i class="fa fa-save" style="padding : 0px"></i> Update</button>
<button type="submit" name="selesai" class="btn btn-primary"<?php if ($posisi == ''){ ?> disabled <?php } ?>><i class="fa fa-save" style="padding : 0 px"></i> Selesaikan Shipping</button>
</form>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const provinsiSelect = document.getElementById("provinsi");
    const kotaSelect = document.getElementById("kota");

    // Inisialisasi Select2 sekali saja
    $('#provinsi').select2({
        width: '100%'
    });

    $('#kota').select2({
        width: '100%'
    });

    // Load Provinsi
    fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
        .then(response => response.json())
        .then(data => {

            let html = '<option value="">Pilih Provinsi</option>';

            data.forEach(item => {
                html += `
                    <option data-id="${item.id}" value="${item.name}">
                        ${item.name}
                    </option>
                `;
            });

            provinsiSelect.innerHTML = html;

            // Refresh Select2
            $('#provinsi').trigger('change.select2');
        })
        .catch(error => {
            console.error("Gagal mengambil provinsi:", error);
        });

    // Saat provinsi dipilih
    $('#provinsi').on('change', function () {

    const provinsiId = $(this).find(':selected').data('id');

    console.log('Provinsi ID:', provinsiId);

    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinsiId}.json`)
        .then(response => response.json())
        .then(data => {

            let html = '<option value="">Pilih Kota / Kabupaten</option>';

            data.forEach(item => {
                html += `<option value="${item.name}">${item.name}</option>`;
            });

            $('#kota').html(html).trigger('change');
        })
        .catch(error => {
            console.error(error);
        });

});

});
</script>
</main>

    <script src="script.js"></script>
  </body>
</html>
