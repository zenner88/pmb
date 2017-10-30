<?php
require_once "Excel.class.php";

#koneksi ke mysql
include "../../config/koneksi.php";
#akhir koneksi

#koneksi ke mysql
$mysqli = new mysqli("localhost","root","Admin321","pmb_2015");
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_error . ') ');
}
#akhir koneksi
#ambil data
$query = "select t_herregistrasi.npm, t_calon_mahasiswa.n_lengkap, 
t_calon_mahasiswa.n_jns_kelamin,
t_calon_mahasiswa.n_temp_lahir,
t_calon_mahasiswa.d_lahir,
t_calon_mahasiswa.n_alamat,
t_kab.nama_kab,
t_prop.nama_prop,
t_calon_mahasiswa.c_pos,
t_calon_mahasiswa.i_telp,
t_calon_mahasiswa.i_hp,
t_calon_mahasiswa.n_email,
t_calon_mahasiswa.n_ortu,
t_calon_mahasiswa.n_sma,
t_calon_mahasiswa.c_gel,
t_jurusan.NamaJrsn, t_herregistrasi.status_bayar, t_herregistrasi.bukti_bayar, t_herregistrasi.validator, t_herregistrasi.ijazah, t_herregistrasi.transkrip, t_herregistrasi.akte, t_herregistrasi.photo, t_herregistrasi.skck, t_herregistrasi.surat_pernyataan, t_herregistrasi.jasket, t_herregistrasi.sepatu
FROM t_herregistrasi 
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi.i_registrasi
inner join t_prop on t_calon_mahasiswa.n_propinsi=t_prop.kd_prop
inner join t_kab on t_kab.kd_kab=t_calon_mahasiswa.n_kabupaten
";
$sql = $mysqli->query($query);



$arrmhs = array();
while ($row = $sql->fetch_assoc()) {
	array_push($arrmhs, $row);
}
#akhir data

$excel = new Excel();
#Send Header
$excel->setHeader('laporan_heregistrasi_semua.xls');
$excel->BOF();

#header tabel
$excel->writeLabel(0, 0, "NIM");
$excel->writeLabel(0, 1, "NAMA");
$excel->writeLabel(0, 2, "JENIS KELAMIN");
$excel->writeLabel(0, 3, "TEMPAT LAHIR");
$excel->writeLabel(0, 4, "TANGGAL LAHIR");
$excel->writeLabel(0, 5, "ALAMAT");
$excel->writeLabel(0, 6, "KAB/KOTA");
$excel->writeLabel(0, 7, "PROPINSI");
$excel->writeLabel(0, 8, "KODE POS");
$excel->writeLabel(0, 9, "TELEPON");
$excel->writeLabel(0, 10, "HP");
$excel->writeLabel(0, 11, "EMAIL");
$excel->writeLabel(0, 12, "NAMA ORANGTUA");
$excel->writeLabel(0, 13, "SMA");
$excel->writeLabel(0, 14, "GELOMBANG");
$excel->writeLabel(0, 15, "JURUSAN");
$excel->writeLabel(0, 16, "STATUS");
$excel->writeLabel(0, 17, "TEMPAT PEMBAYARAN");
$excel->writeLabel(0, 18, "VALIDATOR");
$excel->writeLabel(0, 19, "IJAZAH");
$excel->writeLabel(0, 20, "TRANSKRIP");
$excel->writeLabel(0, 21, "AKTE");
$excel->writeLabel(0, 22, "PHOTO");
$excel->writeLabel(0, 23, "SKCK");
$excel->writeLabel(0, 24, "SURAT PERNYATAAN");
$excel->writeLabel(0, 25, "JASKET");
$excel->writeLabel(0, 26, "SEPATU");

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
