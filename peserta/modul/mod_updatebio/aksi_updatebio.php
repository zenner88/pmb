<?php
session_start();
 if (empty($_SESSION['briva']) AND empty($_SESSION['password'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../config/antisqlinjection.php";

$module=$_GET[module];
$act=$_GET[act];

// Update profil
if ($module=='updatebio' AND $act=='updatereg'){
$i_registrasi=$_POST['pin'];
$i_thn_akademik=$_POST['i_thn_akademik'];
$c_gel=$_POST['c_gel'];
$n_lengkap=$_POST['n_lengkap'];
$n_jns_kelamin=$_POST['n_jns_kelamin'];
$n_temp_lahir=$_POST['n_temp_lahir'];
$d_lahir=$_POST['d_lahir'];
$n_alamat=$_POST['n_alamat'];
$n_kabupaten=$_POST['n_kabupaten'];
$n_propinsi=$_POST['n_propinsi'];
$n_kota_lain=$_POST['n_kota_lain'];
$c_pos=$_POST['c_pos'];
$i_telp=$_POST['i_telp'];
$i_hp=$_POST['i_hp'];
$n_email=$_POST['n_email'];
$n_ortu=$_POST['n_ortu'];
$n_instansi=$_POST['n_instansi'];
$n_jabatan=$_POST['n_jabatan'];
$n_sma=$_POST['n_sma'];
$i_jur_sma=$_POST['i_jur_sma'];
$n_alamat_sma=$_POST['n_alamat_sma'];
$n_kab_sma=$_POST['n_kab_sma'];
$n_prop_sma=$_POST['n_prop_sma'];
$n_pil1=$_POST['n_pil1'];
$n_pil2=$_POST['n_pil2'];
$n_pil3=$_POST['n_pil3'];
$i_temp_ujian=$_POST['i_temp_ujian'];
$c_inf=$_POST['c_inf'];
$q_sdp2=$_POST['q_sdp2'];
$e_prestasi=$_POST['e_prestasi'];
$c_jalur=$_POST['c_jalur'];
$i_foto = $_POST['photo'];
$tglsekarang = date('Y-m-d H:i:s');
replace_meta_chars(mysql_query("UPDATE `pmb`.`t_calon_mahasiswa` SET `n_lengkap` = '$n_lengkap',
`n_jns_kelamin` = '$n_jns_kelamin',
`n_temp_lahir` = '$n_temp_lahir',
`d_lahir` = '$d_lahir',
`n_alamat` = '$n_alamat',
`n_kabupaten` = '$n_kabupaten',
`n_propinsi` = '$n_propinsi',
`c_pos` = '$c_pos',
`i_telp` = '$i_telp',
`i_hp` = '$i_hp',
`n_ortu` = '$n_ortu',
`n_jabatan` = '$n_jabatan',
`n_sma` = '$n_sma',
`i_jur_sma` = '$i_jur_sma',
`n_alamat_sma` = '$n_alamat_sma',
`n_kab_sma` = '$n_kab_sma',
`n_prop_sma` = '$n_prop_sma',
`status_update` = '1',
`waktu_update` = '$tglsekarang',
`history` = 'Peserta' WHERE CONVERT( `t_calon_mahasiswa`.`i_registrasi` USING utf8 ) = '$i_registrasi' LIMIT 1 ;"));
header('location:../../media.php?module='.$module);
}
if ($module=='updatebio' AND $act=='updatepmdk'){
$i_registrasi=$_POST['pin'];
$i_thn_akademik=$_POST['i_thn_akademik'];
$c_gel=$_POST['c_gel'];
$n_lengkap=$_POST['n_lengkap'];
$n_jns_kelamin=$_POST['n_jns_kelamin'];
$n_temp_lahir=$_POST['n_temp_lahir'];
$d_lahir=$_POST['d_lahir'];
$n_alamat=$_POST['n_alamat'];
$n_kabupaten=$_POST['n_kabupaten'];
$n_propinsi=$_POST['n_propinsi'];
$n_kota_lain=$_POST['n_kota_lain'];
$c_pos=$_POST['c_pos'];
$i_telp=$_POST['i_telp'];
$i_hp=$_POST['i_hp'];
$n_email=$_POST['n_email'];
$n_ortu=$_POST['n_ortu'];
$n_instansi=$_POST['n_instansi'];
$n_jabatan=$_POST['n_jabatan'];
$n_sma=$_POST['n_sma'];
$i_jur_sma=$_POST['i_jur_sma'];
$n_alamat_sma=$_POST['n_alamat_sma'];
$n_kab_sma=$_POST['n_kab_sma'];
$n_prop_sma=$_POST['n_prop_sma'];
$n_pil1=$_POST['n_pil1'];
$n_pil2=$_POST['n_pil2'];
$n_pil3=$_POST['n_pil3'];
$q_sdp2=$_POST['q_sdp2'];
$e_prestasi=$_POST['e_prestasi'];
$rata2_XI_2=$_POST['rata2_XI_2'];
$mtk_XI_2=$_POST['mtk_XI_2'];
$ing_XI_2=$_POST['ing_XI_2'];
$rata2_XII_1=$_POST['rata2_XII_1'];
$mtk_XII_1=$_POST['mtk_XII_1'];
$ing_XII_1=$_POST['ing_XII_1'];
$c_jalur=$_POST['c_jalur'];
$i_foto = $_POST['photo'];
$tglsekarang = date('Y-m-d H:i:s');
replace_meta_chars(mysql_query("UPDATE `pmb`.`t_calon_mahasiswa` SET `n_lengkap` = '$n_lengkap',
`n_jns_kelamin` = '$n_jns_kelamin',
`n_temp_lahir` = '$n_temp_lahir',
`d_lahir` = '$d_lahir',
`n_alamat` = '$n_alamat',
`n_kabupaten` = '$n_kabupaten',
`n_propinsi` = '$n_propinsi',
`c_pos` = '$c_pos',
`i_telp` = '$i_telp',
`i_hp` = '$i_hp',
`n_ortu` = '$n_ortu',
`n_jabatan` = '$n_jabatan',
`n_sma` = '$n_sma',
`n_alamat_sma` = '$n_alamat_sma',
`i_jur_sma` = '$i_jur_sma',
`n_kab_sma` = '$n_kab_sma',
`n_prop_sma` = '$n_prop_sma',
`rata2_XI_2` = '$rata2_XI_2',
`mtk_XI_2` = '$mtk_XI_2',
`ing_XI_2` = '$ing_XI_2',
`rata2_XII_1` = '$rata2_XII_1',
`mtk_XII_1` = '$mtk_XII_1',
`ing_XII_1` = '$ing_XII_1',
`status_update` = '1',
`waktu_update` = '$tglsekarang',
`history` = 'Peserta' WHERE CONVERT( `t_calon_mahasiswa`.`i_registrasi` USING utf8 ) = '$i_registrasi' LIMIT 1 ;"));
  header('location:../../media.php?module='.$module);
 // echo "<center>Untuk Kembali klik <a href=../../media.php?module=$module><em>disini</em></a></center>";
}
}
?>
