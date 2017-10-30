<?php
session_start();
 if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "../../../config/koneksi.php";
include "../../../config/library.php";

$module=$_GET[module];
$act=$_GET[act];

$tgl_upload = date("Y-m-d H:i:s");

define ("MAX_SIZE","10000"); 
function getExtension($str)
{
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}
 
$errors=0;
$image=$_FILES['bukti_pembayaran']['name'];
if ($image) 
{
	$filename = stripslashes($_FILES['bukti_pembayaran']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") 
		&& ($extension != "gif")&& ($extension != "JPG") && ($extension != "JPEG") 
		&& ($extension != "PNG") && ($extension != "GIF")) 
	{
		echo '<h3>Unknown extension!</h3>';
		$errors=1;
	}
	else
	{
		$size=filesize($_FILES['bukti_pembayaran']['tmp_name']);
 
		if ($size > MAX_SIZE*10024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name=$_POST['id'].'.'.$extension;
		$newname="../../bukti_pembayaran/".$image_name;
 
		$copied = copy($_FILES['bukti_pembayaran']['tmp_name'], $newname);
		
	}
 
}

// Edit Calon Mahasiswa Reguler
if ($module=='daftar' AND $act=='edit'){
	 
	 mysql_query("UPDATE t_daftar SET status = '$_POST[status]', tgl_upload = '$tgl_upload', username = '$_SESSION[namauser]', bukti_pembayaran = '$image_name', jenis='$_POST[jenis]'  
                             WHERE kode_briva   = '$_POST[id]'");
     
  header('location:../../media.php?module='.$module);
}
	
}
?>