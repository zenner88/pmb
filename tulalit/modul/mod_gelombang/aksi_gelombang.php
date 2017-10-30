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

// Update Status Gelombang
if ($module=='gelombang' AND $act=='update'){

    mysql_query("UPDATE t_gel SET status = '$_POST[status]' WHERE Id = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}

}
?>