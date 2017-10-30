<?php
include '../../../config/koneksi.php';
$jur = $_GET['jur'];
$kelas = $_GET['kelas'];
// Ambil data mahasiswa dari kelas dan jurusan yang dipilih
$q = mysql_query("SELECT * FROM t_pin ORDER BY pin ASC");
//$qj = mysql_query("SELECT a.NamaJrsn FROM t_jurusan a WHERE a.Id = $jur");
//$rj = mysql_fetch_array($qj);
?>
<html>
<head>
	<title>Daftar PIN PMB</title>
</head>
<body>
<center>
<table width="700" cellpadding="3" cellspacing="3">
<tr valign="top">
<td width="66"><img src="../../images/Logo.Poltek.Bulat.Transp.png" height="60" width="60"></td>
<td width="611">
  <div align="center"><b>Daftar PIN PMB Politeknik Pos Indonesia<br>
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
		<td>Kode Aktivasi</td>
		<td>Status</td>
	</tr>
	<?php
	$i = 1;
	while ($r = mysql_fetch_array($q))
	{
	
	?>
	<tr valign="top">
		<td><?=$i?></td>
		<td><?=$r['pin']?></td>
		<td><?=$r['kd_aktivasi']?></td>
		<td><?=$r['status']?></td>
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