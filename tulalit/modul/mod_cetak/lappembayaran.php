<?php
include '../../../config/koneksi.php';
$pilihan = $_POST['pt'];
$jalur = $_POST['jalur'];
$status = $_POST['status'];
$jenis= $_POST['jenis'];

		if ($status == 'bayar') $sta= 'Sudah Bayar';
		else $sta= 'Belum Bayar';
		
		if ($pilihan == '1') $pil = 'POLTEKPOS';
              elseif ($pilihan == '2') $pil = 'STIMLOG';
		else $pil = '-';
		
		if ($jalur== '0') $jal= 'PMDK';
		else $jal= 'REGULER';


if ($jenis=='semua')
{
$q = mysql_query("Select * from t_daftar where status='bayar' ORDER BY jenis,nama ASC");
$jum_giro = mysql_num_rows(mysql_query("Select * from t_daftar where  status='bayar' and jenis='Giropos'"));
$jum_bni = mysql_num_rows(mysql_query("Select * from t_daftar where  status='bayar' and jenis='BNI'"));
$jum_kwitansi = mysql_num_rows(mysql_query("Select * from t_daftar where  status='bayar' and jenis='Kwitansi'"));
}

elseif ($jenis=='giropos')
{
$q = mysql_query("Select * from t_daftar where  status='bayar' and jenis='Giropos' ORDER BY jenis,nama ASC");
$jum_giro = mysql_num_rows(mysql_query("Select * from t_daftar where status='bayar' and jenis='Giropos'"));
}

elseif ($jenis=='bni')
{
$q = mysql_query("Select * from t_daftar where status='bayar' and jenis='BNI' ORDER BY jenis,nama ASC");
$jum_bni = mysql_num_rows(mysql_query("Select * from t_daftar where status='bayar' and jenis='BNI'"));
}

else
{
$q = mysql_query("Select * from t_daftar where status='bayar' and jenis='Kwitansi' ORDER BY jenis,nama ASC");
$jum_kwitansi = mysql_num_rows(mysql_query("Select * from t_daftar where status='bayar' and jenis='Kwitansi'"));
}

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
				<td><h3 align="center">LAPORAN PEMABAYARAN PENDAFTAR PMB LEWAT <?=strtoupper($jenis);?> <BR />TAHUN <?=date('Y')?></h3>
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
		else $jalur = 'REGULER';
		
		
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
if ($jenis=='semua')
{
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
}
elseif ($jenis=='giropos')
{
echo"
<tr><td colspan='11' >&nbsp</tr>
<tr bgcolor='#FFFF99'>
<td colspan='3' >JUMLAH PEMBAYARAN LEWAT GIROPOS</td>
<td colspan='8'>$jum_giro </td>
</tr>
";
}
elseif ($jenis=='bni')
{
echo"
<tr><td colspan='11' >&nbsp</tr>
<tr bgcolor='#FFFF99'>
<td colspan='3' >JUMLAH PEMBAYARAN LEWAT BNI</td>
<td colspan='8'>$jum_bni </td>
</tr>
";
}
else
{
echo"
<tr><td colspan='11' >&nbsp</tr>
<tr bgcolor='#FFFF99'>
<td colspan='3' >JUMLAH PEMBAYARAN LEWAT KWITANSI</td>
<td colspan='8'>$jum_kwitansi </td>
</tr>
";
}
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