<?php
include '../../../config/koneksi.php';

$jenis= $_POST['jenis'];

if ($jenis=='semua')
{
$q = mysql_query("select t_herregistrasi.*, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn FROM t_herregistrasi 
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi.i_registrasi 
union
select t_herregistrasi_stimlog.*, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn FROM t_herregistrasi_stimlog
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi_stimlog.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi_stimlog.i_registrasi

");
}

if ($jenis=='poltek')
{
$q = mysql_query("select t_herregistrasi.*, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn FROM t_herregistrasi 
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi.i_registrasi order by t_calon_mahasiswa.n_lengkap");
}

if ($jenis=='stimlog')
{
$q = mysql_query("select t_herregistrasi_stimlog.*, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn FROM t_herregistrasi_stimlog
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi_stimlog.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi_stimlog.i_registrasi order by t_calon_mahasiswa.n_lengkap");
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
				<td><h3 align="center">LAPORAN PEMABAYARAN HERREGISTRASI MAHASISWA BARU <?=strtoupper($jenis);?> <BR />TAHUN <?=date('Y')?></h3>
				<tr><td colspan="5">&nbsp;
				<br>
					<table class="box" width="100%">
						<tbody>
		
						<tr>
							<td>No.</td>
							<td>No.Pendaftaran</td>
							<td>Nama</td>
							<td>NPM</td>
							<td>Jurusan</td>
							<td>Tempat Bayar</td>
							<td>Jumlah Bayar</td>
							<td>Tanggal Bayar</td>
							<td>Status Bayar</td>
							<td>Validator</td>
							<td>Tanggal Validasi</td>
                                    
							<td>File Bayar</td>

							<td>Tempat Bayar Kedua</td>
							<td>Jumlah Bayar Kedua</td>
							<td>Tanggal Bayar Kedua</td>
							<td>Status Bayar Kedua</td>
							<td>Validator Kedua</td>
							<td>Tanggal Validasi Kedua</td>
                                            
							<td>File Bayar Kedua</td>

							
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
		<td><?=$r['i_registrasi']?></td>
		<td><?=strtoupper($r['n_lengkap'])?></td>
		<td><?=$r['npm']?></td>
	 	<td><?=$r['NamaJrsn']?></td>
		<td><?=$r['bukti_bayar']?></td>
		<td><?=$r['jumlah_bayar']?></td>
		<td><?=$r['tgl_bayar']?></td>
		<td><?=$r['status_bayar']?></td>
		<td><?=$r['validator']?></td>
		<td><?=$r['tgl_validasi']?></td>
		<td><a href="../../bukti_herregistrasi/<?=$r['file_bayar'];?>" target='_blank' "><?=$r['file_bayar'];?></a>

		<td><?=$r['bukti_bayar1']?></td>
		<td><?=$r['jumlah_bayar1']?></td>
		<td><?=$r['tgl_bayar1']?></td>
		<td><?=$r['status_bayar1']?></td>
		<td><?=$r['validator1']?></td>
		<td><?=$r['tgl_validasi1']?></td>
		<td><a href="../../bukti_herregistrasi2/<?=$r['file_bayar1'];?>"  target='_blank'"><?=$r['file_bayar1'];?></a>

              
		
	</tr>
	<?php
		$i++;
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