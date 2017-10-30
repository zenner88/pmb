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
$pt= $_POST['pt'];

if ($pt=='all')
{

// Ambil data mahasiswa dari kelas dan jurusan yang dipilih
$q = "SELECT t_calon_mahasiswa.i_registrasi,
t_calon_mahasiswa.n_lengkap,
t_calon_mahasiswa.i_hp,
t_calon_mahasiswa.n_email,
t_calon_mahasiswa.n_sma,
t_calon_mahasiswa.c_gel,
(select NamaJrsn from t_jurusan where KodeJrsn=t_calon_mahasiswa.n_pil1) as pil1,
(select NamaJrsn from t_jurusan where KodeJrsn=t_calon_mahasiswa.n_pil2) as pil2,
(select NamaJrsn from t_jurusan where KodeJrsn=t_calon_mahasiswa.n_pil3) as pil3,
(select NamaTmp from t_tempat_ujian where KodeTmp=t_calon_mahasiswa.i_temp_ujian) as ujian

FROM t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi
WHERE t_calon_mahasiswa.c_jalur = 'reguler' ORDER BY t_calon_mahasiswa.n_sma,t_calon_mahasiswa.n_lengkap ASC";
}

elseif ($pt=='poltekpos')
{
$q = "SELECT t_calon_mahasiswa.i_registrasi,
t_calon_mahasiswa.n_lengkap,
t_calon_mahasiswa.i_hp,
t_calon_mahasiswa.n_email,
t_calon_mahasiswa.n_sma,
t_calon_mahasiswa.c_gel,
(select NamaJrsn from t_jurusan where KodeJrsn=t_calon_mahasiswa.n_pil1) as pil1,
(select NamaJrsn from t_jurusan where KodeJrsn=t_calon_mahasiswa.n_pil2) as pil2,
(select NamaJrsn from t_jurusan where KodeJrsn=t_calon_mahasiswa.n_pil3) as pil3,
(select NamaTmp from t_tempat_ujian where KodeTmp=t_calon_mahasiswa.i_temp_ujian) as ujian
FROM t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi
WHERE t_calon_mahasiswa.c_jalur = 'reguler' and t_daftar.pilihan='1' ORDER BY t_calon_mahasiswa.n_sma,t_calon_mahasiswa.n_lengkap ASC";
}

else
{
$q = "SELECT t_calon_mahasiswa.i_registrasi,
t_calon_mahasiswa.n_lengkap,
t_calon_mahasiswa.i_hp,
t_calon_mahasiswa.n_email,
t_calon_mahasiswa.n_sma,
t_calon_mahasiswa.c_gel,
(select NamaJrsn from t_jurusan where KodeJrsn=t_calon_mahasiswa.n_pil1) as pil1,
(select NamaJrsn from t_jurusan where KodeJrsn=t_calon_mahasiswa.n_pil2) as pil2,
(select NamaJrsn from t_jurusan where KodeJrsn=t_calon_mahasiswa.n_pil3) as pil3,
(select NamaTmp from t_tempat_ujian where KodeTmp=t_calon_mahasiswa.i_temp_ujian) as ujian
FROM t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi
WHERE t_calon_mahasiswa.c_jalur = 'reguler' and t_daftar.pilihan='2' ORDER BY t_calon_mahasiswa.n_sma,t_calon_mahasiswa.n_lengkap ASC";
}


$sql = $mysqli->query($q);



$arrmhs = array();
while ($row = $sql->fetch_assoc()) {
	array_push($arrmhs, $row);
}
#akhir data

$excel = new Excel();
#Send Header
$excel->setHeader('laporan_pendaftar_PMDK.xls');
$excel->BOF();

#header tabel
$excel->writeLabel(0, 0, "NO PENDAFTARAN");
$excel->writeLabel(0, 1, "NAMA");
$excel->writeLabel(0, 2, "NO TELP");
$excel->writeLabel(0, 3, "EMAIL");
$excel->writeLabel(0, 4, "SMA");
$excel->writeLabel(0, 5, "GELOMBANG");
$excel->writeLabel(0, 6, "PILIHAN 1");
$excel->writeLabel(0, 7, "PILIHAN 2");
$excel->writeLabel(0, 8, "PILIHAN 3");
$excel->writeLabel(0, 9, "TEMPAT UJIAN");

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
