<?php
session_start();
include "../config/koneksi.php";
include "config/recaptchalib.php";
$publickey = "6Le8Tr4SAAAAAOwlk7qk8eZJ7i2gzWRXfK7r420n";
$privatekey = "6Le8Tr4SAAAAAEpek74I8a--2ZC5j09NPQfCk1Ux";
 if (empty($_SESSION['kode_briva']) AND empty($_SESSION['password'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_kartuujian/aksi_kartuujian.php";
switch($_GET[act]){
  // Tampil Komentar
  default:
    echo "<h2>Cetak Biodata PMB Online Politeknik Pos Indonesia</h2>";
echo $_SESSION['kode_briva'];
	echo "<a href='$aksi?pin=$_SESSION[kode_briva]' target='top_blank'><input type='button' value='Cetak Biodata'></a>";
    break;
}
}
?>
