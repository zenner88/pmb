<?php
include "../config/koneksi.php";
//$cek=mysql_fetch_array(mysql_query("SELECT t_calon_mahasiswa.* FROM t_calon_mahasiswa
//inner join t_daftar on t_daftar.kode_briva = t_calon_mahasiswa.i_registrasi  WHERE t_calon_mahasiswa.i_registrasi='$_SESSION[kode_briva]'"));
//$jumlah= mysql_num_rows ($cek); 
//echo "$jumlah";
if ($_SESSION['jalur_pendaftaran'] == "Reguler") {
	echo "<li><a href='?module=registrasi'><B>Registrasi</B></a></li>";
	echo "<li><a href='#'><B>Her-Registrasi MABA</B></a></li>";	
	echo "<li><a href='?module=kartuujian'><B>Cetak Kartu Ujian</B></a></li>";
} else {
	echo "<li><a href='?module=registrasi'><B>Registrasi</B></a></li>";
	echo "<li><a href='#'><B>Her-Registrasi MABA</B></a></li>";
}
/*if ($_SESSION["jalur_pendaftaran"]){
    echo "<li><a href='?module=registrasi'><B>Registrasi</B></a></li>";
IF (isset($cek['status']) == 'lunas' OR  isset($cek['status']) == 'belum'){
 	echo "<li><a href='?module=herregistrasi'><B>Her-Registrasi MABA</B></a></li>";}

ELSE {
echo "<li><a href='#'><B>Her-Registrasi MABA</B></a></li>";}
	if (isset($_SESSION['jalur_pendaftaran'])=="Reguler"){
    //echo "<li><a href='?module=biodata'>&#187; Cetak Biodata</a></li>";
	echo "<li><a href='?module=kartuujian'><B>Cetak Kartu Ujian</B></a></li>";
	}
	//echo "<li><a href='?module=konfirmpay'>&#187; Konfirmasi Pembayaran</a></li>";
    }*/
?>
