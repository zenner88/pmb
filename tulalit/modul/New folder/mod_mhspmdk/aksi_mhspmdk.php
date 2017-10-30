<?php
session_start();
 if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "../../../koneksi/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Edit Calon Mahasiswa PMDK
if ($module=='mhspmdk' AND $act=='editreg'){
	 
	 mysql_query("UPDATE t_calon_mahasiswa SET n_pil1 = '$_POST[pil1]',
                                   n_pil2 = '$_POST[pil2]', 
                                   n_pil3 = '$_POST[pil3]',
                                   q_sdp2  = '$_POST[q_sdp2]',
								   n_ortu = '$_POST[n_ortu]',
								   n_instansi = '$_POST[n_instansi]',
								   n_jabatan = '$_POST[n_jabatan]',
								   n_lengkap = '$_POST[n_lengkap]',
								   n_jns_kelamin = '$_POST[n_jns_kelamin]',
								   n_temp_lahir = '$_POST[n_temp_lahir]',
								   d_lahir = '$_POST[d_lahir]',
								   n_alamat = '$_POST[n_alamat]',
								   n_propinsi = '$_POST[prop]',
								   n_kabupaten = '$_POST[kab]',
								   n_kota_lain = '$_POST[n_kota_lain]',
								   c_pos = '$_POST[c_pos]',
								   i_telp = '$_POST[i_telp]',
								   i_hp = '$_POST[i_hp]',
								   n_email = '$_POST[n_email]',
								   n_sma = '$_POST[n_sma]',
								   i_jur_sma = '$_POST[i_jur_sma]',
								   n_alamat_sma = '$_POST[n_alamat_sma]',
								   n_prop_sma = '$_POST[n_prop_sma]',
								   n_kab_sma = '$_POST[n_kab_sma]',
								   e_prestasi = '$_POST[e_prestasi]',
								   rata2_XI_2 = '$_POST[rataXI]',
								   mtk_XI_2 = '$_POST[mtkXI]',
								   ing_XI_2 = '$_POST[ingXI]',
								   rata2_XII_1 = '$_POST[rataXII]',
								   mtk_XII_1 = '$_POST[mtkXII]',
								   ing_XII_1 = '$_POST[ingXII]'
                             WHERE i_registrasi   = '$_POST[id]'");
     
  header('location:../../media.php?module='.$module);
}
	
}
?>