<?php
session_start();
include "../../../config/koneksi.php";


$cek=$_POST[cek];
$jumlah=count($cek);

  for($i=0;$i<$jumlah;$i++){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM sekilasinfo WHERE id_sekilas='$cek[$i]'"));
   if ($data[gambar]!=''){       
     mysql_query("DELETE FROM sekilasinfo WHERE id_sekilas='$cek[$i]'");
     unlink("../../../foto_info/$data[gambar]");   
     unlink("../../../foto_info/kecil_$data[gambar]");  
      }
      else{ 
           mysql_query("DELETE FROM sekilasinfo WHERE id_sekilas='$cek[$i]'");
       }
     header('location:../../media.php?module=sekilasinfo');
	 }
?>