<?php
include '../../../config/koneksi.php';
$validator= $_POST['validator'];


if ($validator=='semua')
{
$q = mysql_query("Select * from t_daftar
where status='bayar' ORDER BY jenis,nama ASC");
$jum= mysql_num_rows(mysql_query("Select * from t_daftar where status='bayar'"));
}

else
{
$q = mysql_query("Select * from t_daftar
where status='bayar' and username='$validator'  ORDER BY jenis,nama ASC");
$jum= mysql_num_rows(mysql_query("Select * from t_daftar where status='bayar' and username='$validator'"));
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
				<td><h3 align="center">LAPORAN DATA VALIDATOR PEMBAYARAN PENDAFTAR PMB POLTEKPOS - STIMLOG <BR />TAHUN <?=date('Y')?></h3>
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
<td colspan='3' >JUMLAH </td>
<td colspan='8'>$jum</td>
</tr>
";
}

else
{
echo"
<tr><td colspan='11' >&nbsp</tr>
<tr bgcolor='#FFFF99'>
<td colspan='3' >JUMLAH </td>
<td colspan='8'>$jum</td>
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