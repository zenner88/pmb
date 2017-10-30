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

// Edit Calon Mahasiswa Reguler
if ($module=='herregistrasi' AND $act=='edit'){

$mulai=$_POST[thn_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[tgl_mulai];
$pt=$_POST[i_registrasi];
$tpt=substr($pt,5,1);

if ($tpt=='1')
{
$fakultas=$_POST[pil1];
$status=$_POST[status];

$cekprodi=mysql_fetch_array(mysql_query("SELECT * FROM t_jurusan WHERE KodeJrsn='$fakultas'"));
$cekth=mysql_fetch_array(mysql_query("SELECT * FROM t_tahun_akademik WHERE status='on'"));

$ceknomor=mysql_fetch_array(mysql_query("SELECT npm FROM t_herregistrasi WHERE id_jur='$fakultas' ORDER BY npm DESC"));
$cekbayar=mysql_fetch_array(mysql_query("SELECT * FROM t_herregistrasi where i_registrasi='$pt'"));

$cekQ=$ceknomor[npm];
#menghilangkan huruf
$awalQ=substr($cekQ,0-3);
#ketemu angka awal(angka sebelumnya) + dengan 1
$next=$awalQ+1;
#menhitung jumlah karakter
$jnim=strlen($next);

if(!$cekbayar['status_bayar']) 
{

if(!$ceknomor['npm'])
{ $no='001'; }
elseif($jnim==1)
{ $no='00'; }
elseif($jnim==2)
{ $no='0'; }

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
 
		if ($size > MAX_SIZE*1024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name=$_POST['id'].'.'.$extension;
		$newname="../../bukti_herregistrasi/".$image_name;
 
		$copied = copy($_FILES['bukti_pembayaran']['tmp_name'], $newname);
		
	}
 
}


#Pembuatan nim baru
$nimbr=$cekQ=$cekprodi[jur].$cekth[th].$cekprodi[jen].$no.$next;
	 
	 mysql_query("insert into t_herregistrasi (i_registrasi,npm,id_jur,status_bayar,bukti_bayar,file_bayar,tgl_bayar,jumlah_bayar,total_biaya,validator,tgl_validasi) 
values('$pt','$nimbr','$fakultas','$_POST[status]','$_POST[jenis]','$image_name','$mulai','$_POST[bayar]','$cekprodi[biaya]','$_SESSION[namauser]','$tgl_upload')");

if ($status=='lunas')
{
mysql_query("update t_calon_mahasiswa set n_pil1='$fakultas', status='lunas' where i_registrasi='$pt'");
}
elseif ($status=='belum')
{
mysql_query("update t_calon_mahasiswa set n_pil1='$fakultas', status='belum' where i_registrasi='$pt'");
}    

header('location:../../media.php?module='.$module);
}

elseif ($cekbayar['status_bayar']=='belum')
{
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
$image2=$_FILES['bukti_pembayaran']['name'];
if ($image2) 
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
 
		if ($size > MAX_SIZE*1024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name2=$_POST['id'].'.'.$extension;
		$newname2="../../bukti_herregistrasi2/".$image_name2;
 
		$copied = copy($_FILES['bukti_pembayaran']['tmp_name'], $newname2);
		
	}
 
}

mysql_query("update t_calon_mahasiswa set  status='lunas' where i_registrasi='$pt'");
mysql_query("update t_herregistrasi set  
status_bayar='$_POST[status]',
bukti_bayar1='$_POST[jenis]',
file_bayar1='$image_name2',
tgl_bayar1='$mulai',
jumlah_bayar1='$_POST[bayar]',
validator1='$_SESSION[namauser]',
tgl_validasi1='$tgl_upload'
where i_registrasi='$pt'");

header('location:../../media.php?module='.$module);
} 

}


elseif ($tpt=='2')
{
$fakultas=$_POST[pil1];
$status=$_POST[status];

$cekprodi=mysql_fetch_array(mysql_query("SELECT * FROM t_jurusan WHERE KodeJrsn='$fakultas'"));
$cekth=mysql_fetch_array(mysql_query("SELECT * FROM t_tahun_akademik WHERE status='on'"));

$ceknomor=mysql_fetch_array(mysql_query("SELECT npm FROM t_herregistrasi_stimlog WHERE id_jur='$fakultas' ORDER BY npm DESC"));
$cekbayar=mysql_fetch_array(mysql_query("SELECT * FROM t_herregistrasi_stimlog where i_registrasi='$pt'"));

$cekQ=$ceknomor[npm];
#menghilangkan huruf
$awalQ=substr($cekQ,0-3);
#ketemu angka awal(angka sebelumnya) + dengan 1
$next=$awalQ+1;
#menhitung jumlah karakter
$jnim=strlen($next);

if(!$cekbayar['status_bayar']) 
{
 
if(!$ceknomor['npm'])
{ $no='001'; }
elseif($jnim==1)
{ $no='00'; }
elseif($jnim==2)
{ $no='0'; }

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
 
		if ($size > MAX_SIZE*1024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name=$_POST['id'].'.'.$extension;
		$newname="../../bukti_herregistrasi/".$image_name;
 
		$copied = copy($_FILES['bukti_pembayaran']['tmp_name'], $newname);
		
	}
 
}

#Pembuatan nim baru
$nimbr=$cekQ=$cekprodi[jur].$cekth[th].$no.$next;
	 
	 mysql_query("insert into t_herregistrasi_stimlog (i_registrasi,npm,id_jur,status_bayar,bukti_bayar,file_bayar,tgl_bayar,jumlah_bayar,total_biaya,validator,tgl_validasi) 
values('$pt','$nimbr','$fakultas','$_POST[status]','$_POST[jenis]','$image_name','$mulai','$_POST[bayar]','$cekprodi[biaya]','$_SESSION[namauser]','$tgl_upload')");

if ($status=='lunas')
{
mysql_query("update t_calon_mahasiswa set n_pil1='$fakultas', status='lunas' where i_registrasi='$pt'");
}
elseif ($status=='belum')
{
mysql_query("update t_calon_mahasiswa set n_pil1='$fakultas', status='belum' where i_registrasi='$pt'");
}    

header('location:../../media.php?module='.$module);
}

elseif ($cekbayar['status_bayar']=='belum')
{
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
$image2=$_FILES['bukti_pembayaran']['name'];
if ($image2) 
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
 
		if ($size > MAX_SIZE*1024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name2=$_POST['id'].'.'.$extension;
		$newname2="../../bukti_herregistrasi2/".$image_name2;
 
		$copied = copy($_FILES['bukti_pembayaran']['tmp_name'], $newname2);
		
	}
 
}

mysql_query("update t_calon_mahasiswa set  status='lunas' where i_registrasi='$pt'");
mysql_query("update t_herregistrasi_stimlog set  
status_bayar='$_POST[status]',
bukti_bayar1='$_POST[jenis]',
file_bayar1='$image_name2',
tgl_bayar1='$mulai',
jumlah_bayar1='$_POST[bayar]',
validator1='$_SESSION[namauser]',
tgl_validasi1='$tgl_upload'
where i_registrasi='$pt'");
     
header('location:../../media.php?module='.$module);
}

}

}
	
}
?>