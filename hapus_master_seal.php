<?php

include "koneksi.php";

	 if(isset($_GET['nomer_seal']))
	{
		$nomer_seal= $_GET['nomer_seal'];
		$sql="delete from data_seal where nomer_seal = '$nomer_seal'";
		$sql1="delete from monitoring_seal where nomer_seal = '$nomer_seal'";
		$sql2="delete from data_stock_seal where nomer_seal = '$nomer_seal'";
        $hasil=mysqli_query($koneksi,$sql);
		$hasil=mysqli_query($koneksi,$sql1);
		mysqli_query($koneksi,$sql1);		
		mysqli_query($koneksi,$sql);
	    mysqli_close($koneksi);
	    header("Location:master_seal.php");
	}

?>