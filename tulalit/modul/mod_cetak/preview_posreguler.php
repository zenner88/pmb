<?php
include '../../../config/koneksi.php';
$pilihan = $_POST['pt'];
$jalur = $_POST['jalur'];
$status = $_POST['status'];

		if ($status == 'bayar') $sta= 'Sudah Bayar';
		else $sta= 'Belum Bayar';
		
		if ($pilihan == '1') $pil = 'POLTEKPOS';
              elseif ($pilihan == '2') $pil = 'STIMLOG';
		else $pil = '-';
		
		if ($jalur== '0') $jal= 'PMDK';
		else $jal= 'REGULER';
		
		if ($jalur== '0') $jal= 'Undangan';
		else $jal= 'REGULER';


// Ambil data mahasiswa dari kelas dan jurusan yang dipilih
$q = mysql_query("Select * from t_daftar where pilihan='$pilihan' and jalur_pendaftaran='$jalur' and status='$status' ORDER BY nama ASC");
//$qj = mysql_query("SELECT a.NamaJrsn FROM t_jurusan a WHERE a.Id = $jur");
//$rj = mysql_fetch_array($qj);

$jum_giro = mysql_num_rows(mysql_query("Select * from t_daftar where pilihan='$pilihan' and jalur_pendaftaran='$jalur' and status='$status' and jenis='Giropos'"));

$jum_bni = mysql_num_rows(mysql_query("Select * from t_daftar where pilihan='$pilihan' and jalur_pendaftaran='$jalur' and status='$status' and jenis='BNI'"));

$jum_kwitansi = mysql_num_rows(mysql_query("Select * from t_daftar where pilihan='$pilihan' and jalur_pendaftaran='$jalur' and status='$status' and jenis='Kwitansi'"));

?>
<html>
<head>
<script language="Javascript1.2">
  <!--
  function printpage() {
  window.print();
  }
  //-->
</script>
	<title>Laporan Daftar Pendaftar PMB</title>
</head>


	<!-- Stylesheets -->
	<link rel="stylesheet" href="../../orange.css">
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
	
	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<body onload="printpage()">
<table table style="text-align: left; margin: 0pt auto;" align="center" 
cellpadding="0" cellspacing="0" width="90%">
<tr>

			<tbody>
			<tr>
				<td><h3 align="center">LAPORAN PENDAFTAR PMB <?=$pil;?> Jalur <?=$jal;?> Status <?=$sta?><BR />TAHUN <?=date('Y')?></h3>
				<tr><td colspan="5">&nbsp;
				<br>
					<table class="box" width="100%">
						<tbody>
		
						<tr>
							<td>No.</td>
							<td>No.Pendaftaran</td>
							<td>Nama</td>
							<td>No Telp</td>
							<td>Email</td>
							<td>Perguruan Tinggi</td>
							<td>Jalur</td>
							<td>Tanggal Daftar</td>
							<td>Tanggal Validasi</td>
							<td>Pembayaran</td>
                                                <td>Validator</td>

							
						</tr>
	<?php
	$i = 1;
	while ($r = mysql_fetch_array($q))
	{
		if ($r['status'] == 'bayar') $status = 'Sudah Bayar';
		else $status = 'Belum Bayar';
		
		if ($r['pilihan'] == '1') $pil = 'POLTEKPOS';
              elseif ($r['pilihan'] == '2') $pil = 'STIMLOG';
		else $pil = '-';
		
		
		if ($r['jalur_pendaftaran'] == '0') $jalur = 'PMDK';
		if ($r['jalur_pendaftaran'] == '1') $jalur = 'REGULER';
		if ($r['jalur_pendaftaran'] == '2') $jalur = 'UNDANGAN';
	
		
		
	?>
	<tr>
		<td><?=$i?></td>
		<td><?=$r['kode_briva']?></td>
		<td><?=strtoupper($r['nama'])?></td>
		
		<td><?=$r['no_tlp']?></td>
		<td><?=$r['email']?></td>
		<td><?=$pil?></td>
		<td><?=$jalur?></td>
		<td><?=$r['tgl_daftar']?></td>
		<td><?=$r['tgl_upload']?></td>
              <td><?=strtoupper($r['jenis'])?></td>
              <td><?=strtoupper($r['username'])?></td>
		
	</tr>
	<?php
		$i++;
	}

echo"
<tr><td colspan='11' >&nbsp</tr>
<tr bgcolor='#FFFF99'>
<td colspan='3' >JUMLAH PEMBAYARAN LEWAT GIROPOS</td>
<td colspan='8'>$jum_giro </td>
</tr>
<tr bgcolor='#FFFF99'>
<td colspan='3' >JUMLAH PEMBAYARAN LEWAT BNI</td>
<td colspan='8'>$jum_bni </td>
</tr>
<tr bgcolor='#FFFF99'>
<td colspan='3' >JUMLAH PEMBAYARAN LEWAT KWITANSI PMB</td>
<td colspan='8'>$jum_kwitansi </td>
</tr>
";
	?>
</tbody></table>
</td></tr>
			  </td>
			  </tr>
			</tr>
		</tbody></table>
<table width="90%" table style="text-align: left; margin: 0pt auto;" 
cellpadding="0" cellspacing="0">
<tr valign="top">
<td colspan="2" style="font-family:Tahoma;font-size:10px;" align="center"><hr>
Copyright &copy; <?=date('Y')?> Markom dan TIK YPBPI<br>
dicetak tanggal : <?=date('d-M-Y')?>
</td>
</tr>
</table>
</center>
</body>
</html>