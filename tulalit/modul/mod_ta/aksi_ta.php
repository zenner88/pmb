<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "../../../config/koneksi.php";
include "../../../config/library.php";

$module=$_GET[module];
$act=$_GET[act];

// Input Jenjang
if ($module=='tahun' AND $act=='input'){

    mysql_query("INSERT INTO t_tahun_akademik(d_akademik, n_akademik, status) VALUES('$_POST[d_akademik]','$_POST[n_akademik]','$_POST[status]')");

  header('location:../../media.php?module='.$module);
}

// Update Jenjang
elseif ($module=='tahun' AND $act=='update'){

$ta = mysql_query("UPDATE t_tahun_akademik SET d_akademik = '$_POST[d_akademik]',n_akademik = '$_POST[n_akademik]',status = '$_POST[status]' WHERE id_thn_akademik = '$_POST[id]'");
//if ($ta = 0) {
if ($_POST[status]=='on')	{
	mysql_query("UPDATE t_tahun_akademik SET status = 'off' WHERE id_thn_akademik <> '$_POST[id]'");
}

  header('location:../../media.php?module='.$module);
}
}
?>