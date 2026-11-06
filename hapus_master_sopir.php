<?php

include "koneksi.php";

	 if(isset($_GET['nama_sopir']))
	{
		$nama_sopir= $_GET['nama_sopir'];
		$sql="delete from data_sopir where nama_sopir = '$nama_sopir'";
        $hasil=mysqli_query($koneksi,$sql);
		mysqli_query($koneksi,$sql);
	    mysqli_close($koneksi);
	    header("Location:master_sopir.php");
	}

?>