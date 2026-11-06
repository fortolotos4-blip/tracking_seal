<?php

include "koneksi.php";

	 if(isset($_GET['nomer_container']))
	{
		$nomer_container= $_GET['nomer_container'];
		$sql="delete from data_container where nomer_container = '$nomer_container'";
        $hasil=mysqli_query($koneksi,$sql);		
		mysqli_query($koneksi,$sql);
	    mysqli_close($koneksi);
	    header("Location:master_container.php");
	}

?>