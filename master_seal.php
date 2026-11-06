
<!DOCTYPE html>
<!-- YouTube or Website - CodingLab -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Master Seal</title>
    <link rel="stylesheet" href="style.css?v=12" />
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

    <div class="content-wrapper">

        <div class="seal-heading">
    <h2>Master Seal</h2>
    <p>Pengelolaan data master seal</p>
</div>

        <div class="grid-test">

            <div>
                <form method="POST" action="tambah_master_seal.php">
                    <button type="submit" class="btn btn-info">
                        <i class="fa-solid fa-plus"></i>
                        Tambah Data
                    </button>
                </form>
            </div>

            <div>
                <form method="POST" action="export_seal.php">
                    <button type="submit" name="export"
                            class="btn btn-success">
                        <i class="fa-solid fa-file-excel"></i>
                        Export
                    </button>
                </form>
            </div>

        </div>

        <div class="table-container">

            <table class="tabel-data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomer Seal</th>
                        <th>Tanggal Ambil</th>
                        <th>Tempat Penyimpanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                include "koneksi.php";

                $nomer = 1;

                $query = mysqli_query(
                    $koneksi,
                    "SELECT * FROM data_seal"
                );

                while ($data = mysqli_fetch_assoc($query)) {
                ?>

                    <tr>
                        <td><?= $nomer++ ?></td>
                        <td><?= htmlspecialchars($data['nomer_seal']) ?></td>
                        <td><?= htmlspecialchars($data['tanggal_ambil']) ?></td>
                        <td><?= htmlspecialchars($data['tempat_penyimpanan']) ?></td>

                        <td>
                            <a href="ubah_master_seal.php?nomer_seal=<?= urlencode($data['nomer_seal']) ?>"
                               class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <a href="hapus_master_seal.php?nomer_seal=<?= urlencode($data['nomer_seal']) ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>

                <?php } ?>

                </tbody>
            </table>

        </div>

    </div>

</main>

<script>
$(document).ready(function() {
    $('.tabel-data').DataTable();
});
</script>

    <script src="script.js"></script>
  </body>
</html>
