<?php
session_start();
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];
$id=$_POST[id];

// Hapus YM
if ($module=='ym' AND $act=='hapus'){
  mysql_query("DELETE FROM mod_ym WHERE id='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input YM
elseif ($module=='ym' AND $act=='input'){
  mysql_query("INSERT INTO mod_ym(nama,username) VALUES('$_POST[nama]','$_POST[username]')");
  header('location:../../media.php?module='.$module);
}

// Update YM
elseif ($module=='ym' AND $act=='update'){
  mysql_query("UPDATE mod_ym SET nama='$_POST[nama]',username='$_POST[username]' WHERE id = '$id'");
  header('location:../../media.php?module='.$module);
}
?>
