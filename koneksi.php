<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "sql106.infinityfree.com";
$user = "if0_43343105";
$pass = "kngNI1jlqy";
$db   = "if0_43343105_database";

$koneksi = mysqli_connect($host,$user,$pass,$db);

if(!$koneksi){
    die("Koneksi gagal : " . mysqli_connect_error());
}

?>