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
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus download
if ($module=='download' AND $act=='hapus'){
$data=mysql_fetch_array(mysql_query("SELECT nama_file FROM download WHERE id_download='$_GET[id]'"));
  if ($data['nama_file']!=''){
     mysql_query("DELETE FROM download WHERE id_download='$_GET[id]'");
     unlink("../../../files/$data[nama_file]");   
  }
  else{
     mysql_query("DELETE FROM download WHERE id_download='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);
}

// Input download
elseif ($module=='download' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadFile($nama_file);
    mysql_query("INSERT INTO download(judul,
                                    nama_file,
                                    tgl_posting) 
                            VALUES('$_POST[judul]',
                                   '$nama_file',
                                   '$tgl_sekarang')");
  }
  else{
    mysql_query("INSERT INTO download(judul,
                                    tgl_posting) 
                            VALUES('$_POST[judul]',
                                   '$tgl_sekarang')");
  }
  header('location:../../media.php?module='.$module);
}

// Update donwload
elseif ($module=='download' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE download SET judul     = '$_POST[judul]'
                             WHERE id_download = '$_POST[id]'");
  }
  else{
    UploadFile($nama_file);
    mysql_query("UPDATE download SET judul     = '$_POST[judul]',
                                   nama_file    = '$nama_file'   
                             WHERE id_download = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}
}
?>
