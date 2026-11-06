<?php
require 'koneksi.php';
?>
<!DOCTYPE html>
<!-- YouTube or Website - CodingLab -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Export Shipping</title>
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
    <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th>No</th>
                                <th>Nomor Seal</th>
                                <th>Nomor Container</th>
                                <th>Port Tujuan</th>
                                <th>Tanggal Depo</th>
                                <th>Tanggal Shipping Awal</th>
                                <th>Tanggal Shipping Akhir</th>
                                <th>Lokasi</th>
                                <th>Keadaan Seal</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = mysqli_query($koneksi, "SELECT data_shipping.nomer_seal,data_shipping.nomer_container,monitoring_seal.tujuan,deposit_container.tanggal_depo,perjalanan_awal.tanggal_shipping,perjalanan_akhir.tanggal_shipping_akhir,perjalanan_akhir.lokasi_terakhir,perjalanan_akhir.keadaan_seal
                            FROM data_shipping
                            INNER JOIN monitoring_seal ON data_shipping.nomer_seal = monitoring_seal.nomer_seal
                            INNER JOIN deposit_container ON data_shipping.nomer_seal = deposit_container.nomer_seal
                            INNER JOIN perjalanan_awal ON data_shipping.nomer_seal = perjalanan_awal.nomer_seal
                            INNER JOIN perjalanan_akhir ON data_shipping.nomer_seal = perjalanan_akhir.nomer_seal");
                            $nomer = 1;
                            while ($data = mysqli_fetch_array($query)){
                                $nomer_seal= $data['nomer_seal'];
                                $nomer_container = $data['nomer_container'];
                                $tujuan= $data['tujuan'];
                                $tanggal_depo = $data['tanggal_depo'];
                                $tanggal_shipping= $data['tanggal_shipping'];
                                $tanggal_shipping_akhir= $data['tanggal_shipping_akhir'];
                                $lokasi_terakhir = $data['lokasi_terakhir'];
                                $keadaan_seal= $data['keadaan_seal'];
                              }
                            ?>
                            <tr>
                            <td><?=$nomer++;?></td>
                                <td><?php echo $nomer_seal;?></td>
                                <td><?php echo $nomer_container;?></td>
                                <td><?php echo $tujuan;?></td>
                                <td><?php echo $tanggal_depo;?></td>
                                <td><?php echo $tanggal_shipping;?></td>
                                <td><?php echo $tanggal_shipping_akhir;?></td>
                                <td><?php echo $lokasi_terakhir;?></td>
                                <td><?php echo $keadaan_seal;?></td>
                            </tr>
                        </tbody>
                    </table>
                    <script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    </main>
    <script src="script.js"></script>
  </body>
</html>
