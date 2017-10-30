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
include "../../../config/fungsi_seo.php";


$module=$_GET[module];
$act=$_GET[act];
function getRandomString($length = 12) {
    $validCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ";
    $validCharNumber = strlen($validCharacters);
    $result = "";
    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
    return $result;
}
//no pendaftaran
function getNoPendaftaran($length = 12) {
    $validCharacters = "1234567890";
    $validCharNumber = strlen($validCharacters);
    $result = "";
    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
    return $result;
}

// Hapus Pin
if ($module=='pin' AND $act=='hapus'){

     mysql_query("DELETE FROM t_pin WHERE id = '$_GET[id]'");

  header('location:../../media.php?module='.$module);
}

// Input Pin
elseif ($module=='pin' AND $act=='input'){
    if($_POST['jalur']=='pmdk'){
  $sqlTahun = mysql_query("SELECT *
FROM `t_tahun_akademik` where status='on';");
$row_tampil=mysql_fetch_array($sqlTahun);
  $thn = substr($row_tampil[1],2,3);
  $pmdk = $thn."0";
    $sqlLast = mysql_query("SELECT * FROM t_pin WHERE `pin` LIKE CONVERT( _utf8 '$pmdk%' USING latin1 ) ORDER BY pin DESC LIMIT 1;");
$row_last=mysql_fetch_array($sqlLast);
if(mysql_num_rows($sqlLast)>0){
	//$lastId = substr($row_last[1],3,4);v
	$lastId  = $row_last[1];
	} else {
	 $lastId = 0;
}
    $x = ($lastId + $_POST[pin_pmb]);
for ( $i = ($lastId+1) ; $i <= $x ; $i++) {
	if ($lastId == 0){
	if(strlen($i)==1){
	$inc = $pmdk."000000".$i;
	} elseif(strlen($i)==2){
	$inc = $pmdk."00000".$i;
	}
	elseif(strlen($i)==3){
	$inc = $pmdk."0000".$i;
	} 
	elseif(strlen($i)==4){
	$inc = $pmdk."000".$i;
	}
	elseif(strlen($i)==5){
	$inc = $pmdk."00".$i;
	}
	elseif(strlen($i)==6){
	$inc = $pmdk."0".$i;
	}
	elseif(strlen($i)==7){
	$inc = $pmdk.$i;
	}
	} else {
	$inc = $i;
	}
	$kdAktivasi = getRandomString();
	$pendaftaran = getNoPendaftaran();
	
     //echo "PIN : ".$i." Kode Aktivasi : ".getRandomString()."<br/>";
    mysql_query("INSERT INTO t_pin(pin,kd_aktivasi,status,no_pendaftaran,keterangan,status_cetak)
                            VALUES('$inc','$kdAktivasi','nonaktif','$pendaftaran','BNI','on')");
                            }
    } elseif ($_POST['jalur']=='reguler'){
     $sqlTahun = mysql_query("SELECT *
FROM `t_tahun_akademik` where status='on';");
$row_tampil=mysql_fetch_array($sqlTahun);
  $thn = substr($row_tampil[1],2,3);
  $reg = $thn."1";
    $sqlLast = mysql_query("SELECT * FROM t_pin WHERE `pin` LIKE CONVERT( _utf8 '$reg%' USING latin1 ) ORDER BY pin DESC LIMIT 1;");
$row_last=mysql_fetch_array($sqlLast);
if(mysql_num_rows($sqlLast)>0){
	//$lastId = substr($row_last[1],3,4);v
	$lastId  = $row_last[1];
	} else {
	 $lastId = 0;
}
    $x = ($lastId + $_POST[pin_pmb]);
for ( $i = ($lastId+1) ; $i <= $x ; $i++) {
	if (mysql_num_rows($sqlLast)==0){
	if(strlen($i)==1){
	$inc = $reg."000000".$i;
	} elseif(strlen($i)==2){
	$inc = $reg."00000".$i;
	}
	elseif(strlen($i)==3){
	$inc = $reg."0000".$i;
	} 
	elseif(strlen($i)==4){
	$inc = $reg."000".$i;
	}
	elseif(strlen($i)==5){
	$inc = $reg."00".$i;
	}
	elseif(strlen($i)==6){
	$inc = $reg."0".$i;
	}elseif(strlen($i)==7){
	$inc = $reg.$i;
	}
	} else {
	$inc = $i;
	}
	$kdAktivasi = getRandomString();
	$pendaftaran = getNoPendaftaran();
     //echo "PIN : ".$inc." Kode Aktivasi : ".$kdAktivasi."<br/>";
    mysql_query("INSERT INTO t_pin(pin,kd_aktivasi,status,no_pendaftaran,keterangan,status_cetak)
                          VALUES('$inc','$kdAktivasi','nonaktif','$pendaftaran','BNI','on')");
                            }
    }
  header('location:../../media.php?module='.$module);

}

// Update Pin
elseif ($module=='pin' AND $act=='update'){

    mysql_query("UPDATE t_pin SET pin = '$_POST[pin_pmb]',
								  kd_aktivasi = '$_POST[kd_aktivasi]'
                             WHERE id = '$_POST[id]'");

  header('location:../../media.php?module='.$module);
}

// Update Pin Terjual
elseif ($module=='pin' AND $act=='terjual'){
	$user = $_SESSION['namauser'];
    mysql_query("UPDATE t_pin SET status_jual = 'terjual',
								  tgl_jual = '$tgl_sekarang',
								  user_jual = '$user'
                             WHERE id = '$_GET[id]'");

  header('location:../../media.php?module='.$module);
}
}
?>