<?php
include '../../../config/koneksi.php';
$jur = $_GET['jur'];
$kelas = $_GET['kelas'];
// Ambil data mahasiswa dari kelas dan jurusan yang dipilih
$q = mysql_query("SELECT t_kab.nama_kab, t_prop.nama_prop, t_calon_mahasiswa.* FROM t_calon_mahasiswa INNER JOIN t_kab ON t_kab.kd_kab = t_calon_mahasiswa.n_kabupaten INNER JOIN t_prop ON t_prop.kd_prop = t_calon_mahasiswa.n_propinsi WHERE c_jalur='undangan' ORDER BY i_registrasi ASC");
//$qj = mysql_query("SELECT a.NamaJrsn FROM t_jurusan a WHERE a.Id = $jur");
//$rj = mysql_fetch_array($qj);
?>
<html>
<head>
	<title>Daftar Calon Mahasiswa UNDANGAN</title>
</head>
<body>
<center>
<table width="700" cellpadding="3" cellspacing="3">
<tr valign="top">
<td width="64"><img src="../../images/Logo.Poltek.Bulat.Transp.png" height="60" width="60"></td>
<td width="626">
  <div align="center"><b>Daftar Calon Mahasiswa UNDANGAN Politeknik Pos Indonesia<br>
    Tahun Ajaran 
    <?=date('Y')?>
    </b><br>
    <br>
  </div></td>
</tr>
<tr valign="top" height="485">
<td colspan="2">
<table width="100%" cellpadding="3" cellspacing="3" border="1" style="border-collapse:collapse;border-color:#9a9a9a;">
	<tr style="font-weight:bold" valign="top">
		<td>No.</td>
		<td>No.PIN PMB</td>
		<td>Nama Calon Mahasiswa</td>
		<td>Jenis Kelamin</td>
		<td>Alamat</td>
		<td>Kota/Kabupaten</td>
		<td>Provinsi</td>
		<td>No.Telepon</td>
		<td>No.HP</td>
		<td>Email</td>
	</tr>
	<?php
	$i = 1;
	while ($r = mysql_fetch_array($q))
	{
		if ($r['n_jns_kelamin'] == 'L') $jk = 'Laki-laki';
		else $jk = 'Perempuan';
	?>
	<tr valign="top">
		<td><?=$i?></td>
		<td><?=$r['i_registrasi']?></td>
		<td><?=$r['n_lengkap']?></td>
		<td><?=$jk?></td>
		<td><?=$r['n_alamat']?></td>
		<td><?=$r[0]?></td>
		<td><?=$r[1]?></td>
		<td><?=$r['i_telp']?></td>
		<td><?=$r['i_hp']?></td>
		<td><?=$r['n_email']?></td>
	</tr>
	<?php
		$i++;
	}
	?>
</table>
</td>
</tr>
<tr valign="top">
<td colspan="2" style="font-family:Tahoma;font-size:10px;" align="center"><hr>
Copyright &copy; <?=date('Y')?> Poltekpos<br>
dicetak tanggal : <?=date('d-M-Y')?>
</td>
</tr>
</table>
</center>
</body>
</html>