<?php
require_once "Excel.class.php";

#koneksi ke mysql
include "../../config/koneksi.php";
#akhir koneksi

$row2 = mysql_query("select * FROM t_jurusan WHERE KodeJrsn ='$_GET[id]'");
$tam = mysql_fetch_array($row2);

#echo "$tam[NamaJrsn]";
#exit();
#koneksi ke mysql
$mysqli = new mysqli("localhost","root","Admin321","pmb_2015");
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_error . ') ');
}
#akhir koneksi
#ambil data
$query = "select t_herregistrasi.npm, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn, t_herregistrasi.status_bayar, t_herregistrasi.bukti_bayar, t_herregistrasi.validator, t_herregistrasi.ijazah, t_herregistrasi.transkrip, t_herregistrasi.akte, t_herregistrasi.photo, t_herregistrasi.skck, t_herregistrasi.surat_pernyataan, t_herregistrasi.jasket, t_herregistrasi.sepatu
FROM t_herregistrasi 
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi.i_registrasi
WHERE t_jurusan.KodeJrsn = '$_GET[id]'
union
select t_herregistrasi_stimlog.npm, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn, t_herregistrasi_stimlog.status_bayar, t_herregistrasi_stimlog.bukti_bayar, t_herregistrasi_stimlog.validator, t_herregistrasi_stimlog.ijazah, t_herregistrasi_stimlog.transkrip,t_herregistrasi_stimlog.akte, t_herregistrasi_stimlog.photo, t_herregistrasi_stimlog.skck, t_herregistrasi_stimlog.surat_pernyataan, t_herregistrasi_stimlog.jasket, t_herregistrasi_stimlog.sepatu
FROM t_herregistrasi_stimlog
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi_stimlog.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi_stimlog.i_registrasi
WHERE t_jurusan.KodeJrsn = '$_GET[id]'";
$sql = $mysqli->query($query);



$arrmhs = array();
while ($row = $sql->fetch_assoc()) {
	array_push($arrmhs, $row);
}
#akhir data

$excel = new Excel();
#Send Header
$excel->setHeader('laporan_heregistrasi_'.$tam[nami].'.xls');
$excel->BOF();

#header tabel
$excel->writeLabel(0, 0, "NIM");
$excel->writeLabel(0, 1, "NAMA");
$excel->writeLabel(0, 2, "JURUSAN");
$excel->writeLabel(0, 3, "STATUS");
$excel->writeLabel(0, 4, "TEMPAT PEMBAYARAN");
$excel->writeLabel(0, 5, "VALIDATOR");
$excel->writeLabel(0, 6, "IJAZAH");
$excel->writeLabel(0, 7, "TRANSKRIP");
$excel->writeLabel(0, 8, "AKTE");
$excel->writeLabel(0, 9, "PHOTO");
$excel->writeLabel(0, 10, "SKCK");
$excel->writeLabel(0, 11, "SURAT PERNYATAAN");
$excel->writeLabel(0, 12, "JASKET");
$excel->writeLabel(0, 13, "SEPATU");

#isi data
$i = 1;
foreach ($arrmhs as $baris) {
	$j = 0;
	foreach ($baris as $value) {
		$excel->writeLabel($i, $j, $value);
		$j++;
	}
	$i++;
}

$excel->EOF();

exit();
?>
