<?
	session_start();
 if (empty($_SESSION['pin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../koneksi/koneksi.php";
$tgl_sekarang = date("Y-m-d");
$module = "konfirmpay";
mysql_query("INSERT INTO t_registrasi(pin,formulir,pendidikan,matrikulasi,semester1,sumbangan,pembayaran,sisa_bayar,status,metode,lokasi,no_transfer,nama_setor,tgl_transfer,terbilang) VALUES('$_POST[i_registrasi]','$_POST[formulir]','$_POST[pendidikan]','$_POST[matrikulasi]','$_POST[semester1]','$_POST[sumbangan]','$_POST[q_jmlpembayaran]','$_POST[sisa_bayar]','1','$_POST[c_jnspembayaran]','$_POST[n_bank]','$_POST[i_rekening]','$_POST[n_penyetor]','$tgl_sekarang','$_POST[q_jmlpembayaran]')");

mysql_query("UPDATE t_calon_mahasiswa SET metode = 'online' WHERE i_registrasi='$_POST[pin]';");
header('location:../../media.php?module='.$module);
}