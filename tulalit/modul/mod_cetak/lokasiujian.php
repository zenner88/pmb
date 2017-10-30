<?php
include '../../../config/koneksi.php';
$lokasi= $_POST['lokasi'];


		
		
		if ($pilihan == '1') $pil = 'POLTEKPOS';
              elseif ($pilihan == '2') $pil = 'STIMLOG';
		else $pil = '-';
		
if ($lokasi=='Semua')
{

// Ambil data mahasiswa dari kelas dan jurusan yang dipilih
$q = mysql_query("SELECT t_calon_mahasiswa.*, t_tempat_ujian.*, t_daftar.*
						FROM t_calon_mahasiswa
						inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi
						INNER JOIN t_tempat_ujian ON t_calon_mahasiswa.i_temp_ujian = t_tempat_ujian.KodeTmp INNER JOIN t_gel ON t_calon_mahasiswa.c_gel = t_gel.KodeGel
						WHERE t_calon_mahasiswa.c_jalur = 'reguler' AND t_gel.status = 'on' ORDER BY t_tempat_ujian.NamaTmp,t_calon_mahasiswa.n_lengkap ASC");
}

else
{
$q = mysql_query("SELECT t_calon_mahasiswa.*, t_tempat_ujian.*, t_daftar.*
						FROM t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi
						INNER JOIN t_tempat_ujian ON t_calon_mahasiswa.i_temp_ujian = t_tempat_ujian.KodeTmp INNER JOIN t_gel ON t_calon_mahasiswa.c_gel = t_gel.KodeGel
						WHERE t_calon_mahasiswa.c_jalur = 'reguler' and t_tempat_ujian.KodeTmp='$lokasi' AND t_gel.status = 'on' ORDER BY t_tempat_ujian.NamaTmp,t_calon_mahasiswa.n_lengkap ASC");
}



?>
<html>
<head>
	<title>Laporan Daftar Pendaftar PMB</title>
</head>
<script language="Javascript1.2">
  <!--
  function printpage() {
  window.print();
  }
  //-->
</script>

	<!-- Stylesheets -->
	<link rel="stylesheet" href="../../orange.css">
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
	
	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<body onload='printpage()'>
<table table style="text-align: left; margin: 0pt auto;" align="center" 
cellpadding="0" cellspacing="0" width="90%">
<tr>

			<tbody>
			<tr>
				<td><h3 align="center">LAPORAN TEMPAT UJIAN PMB POLTEKPOS - STIMLOG<BR />TAHUN <?=date('Y')?></h3>
				<tr><td colspan="5">&nbsp;
				<br>
					<table class="box" width="100%">
						<tbody>
		
						<tr>
							<td>No.</td>
							<td>No.Pendaftaran</td>
							<td>Nama</td>
							<td>Perguruan Tinggi</td>
							<td>Pilihan 1</td>
							<td>Pilihan 2</td>
							<td>Pilihan 3</td>
							<td>Tempat Ujian</td>
							
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

//D3
	//pil 1
	if ($r[n_pil1] =='01')
	{
		$pil1 = "D3 - Logistik Bisnis";
	}
	
	if($r[n_pil1] =='02')
	{
			$pil1 = "D3 - Manajemen Bisnis";
	}
	if ($r[n_pil1] =='03')
	{
		$pil1 = "D3 - Manajemen Informatika";
	}
	
	if($r[n_pil1] =='04')
	{
			$pil1 = "D3 - Teknik Informatika";
	}
	if($r[n_pil1] =='05')
	{
			$pil1 = "D3 - Akuntansi";
	}
	if($r[n_pil1] =='21')
	{
			$pil1 = "S1 - Manajemen Logistik";
	}
	if($r[n_pil1] =='22')
	{
			$pil1 = "S1 - Manajemen Transportasi";
	}
       
       if($r[n_pil1] =='31')
	{
			$pil1 = "D3 - Akselerasi Teknik Informatika";
	}
	if($r[n_pil1] =='32')
	{
			$pil1 = "D3 - Akselerasi Akuntansi";
	}
	
	if($r[n_pil1] =='34')
	{
			$pil1 = "D4 - CLC (Akselerasi Logistik Bisnis)";
	}
	if($r[n_pil1] =='35')
	{
			$pil1 = "D4 - CAC (Akselerasi Akuntansi)";
	}

	//---pil 2
	if ($r[n_pil2] =='01')
	{
		$pil2 = "D3 - Logistik Bisnis";
	}
	
	if($r[n_pil2] =='02')
	{
			$pil2 = "D3 - Manajemen Bisnis";
	}
	if ($r[n_pil2] =='03')
	{
		$pil2 = "D3 - Manajemen Informatika";
	}
	
	if($r[n_pil2] =='04')
	{
			$pil2 = "D3 - Teknik Informatika";
	}
	if($r[n_pil2] =='05')
	{
			$pil2 = "D3 - Akuntansi";
	}
	if($r[n_pil2] =='21')
	{
			$pil2 = "S1 - Manajemen Logistik";
	}
	if($r[n_pil2] =='22')
	{
			$pil2 = "S1 - Manajemen Transportasi";
	}

      if($r[n_pil2] =='31')
	{
			$pil2 = "D3 - Akselerasi Teknik Informatika";
	}
	if($r[n_pil2] =='32')
	{
			$pil2 = "D3 - Akselerasi Akuntansi";
	}
	
	if($r[n_pil2] =='34')
	{
			$pil2 = "D4 - CLC (Akselerasi Logistik Bisnis)";
	}
	if($r[n_pil2] =='35')
	{
			$pil2 = "D4 - CAC (Akselerasi Akuntansi)";
	}

	//-- pil 3
	if ($r[n_pil3] =='01')
	{
		$pil3 = "D3 - Logistik Bisnis";
	}
	
	if($r[n_pil3] =='02')
	{
			$pil3 = "D3 - Manajemen Bisnis";
	}
	if ($r[n_pil3] =='03')
	{
		$pil3 = "D3 - Manajemen Informatika";
	}
	
	if($r[n_pil3] =='04')
	{
			$pil3 = "D3 - Teknik Informatika";
	}
	if($r[n_pil3] =='05')
	{
			$pil3 = "D3 - Akuntansi";
	}
	if($r[n_pil3] =='21')
	{
			$pil3 = "S1 - Manajemen Logistik";
	}
	if($r[n_pil3] =='22')
	{
			$pil3 = "S1 - Manajemen Transportasi";
	}

	if($r[n_pil3] =='31')
	{
			$pil3 = "D3 - Akselerasi Teknik Informatika";
	}
	if($r[n_pil3] =='32')
	{
			$pil3 = "D3 - Akselerasi Akuntansi";
	}
	
	if($r[n_pil3] =='34')
	{
			$pil3 = "D4 - CLC (Akselerasi Logistik Bisnis)";
	}
	if($r[n_pil3] =='35')
	{
			$pil3 = "D4 - CAC (Akselerasi Akuntansi)";
	}

	//D4
	//pil 1
	if ($r[n_pil1] =='11')
	{
		$pil1 = "D4 - Logistik Bisnis";
	}
	
	if($r[n_pil1] =='12')
	{
			$pil1 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($r[n_pil1] =='13')
	{
		$pil1 = "D4 - Teknik Informatika";
	}
	
	if($r[n_pil1] =='14')
	{
			$pil1 = "D4 - Akuntansi Keuangan";
	}
	//---pil 2
	if ($r[n_pil2] =='11')
	{
		$pil2 = "D4 - Logistik Bisnis";
	}
	
	if($r[n_pil2] =='12')
	{
			$pil2 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($r[n_pil2] =='13')
	{
		$pil2 = "D4 - Teknik Informatika";
	}
	
	if($r[n_pil2] =='14')
	{
			$pil2 = "D4 - Akuntansi Keuangan";
	}
	//-- pil 3
	if ($r[n_pil3] =='11')
	{
		$pil3 = "D4 - Logistik Bisnis";
	}
	
	if($r[n_pil3] =='12')
	{
			$pil3 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($r[n_pil3] =='13')
	{
		$pil3 = "D4 - Teknik Informatika";
	}
	
	if($r[n_pil3] =='14')
	{
			$pil3 = "D4 - Akuntansi Keuangan";
	}

		
		
	?>
	<tr>
		<td><?=$i?></td>
		<td><?=$r['i_registrasi']?></td>
		<td><?=strtoupper($r['n_lengkap'])?></td>
		
		<td><?=$pil?></td>
		<td><?=$pil1?></td>
		<td><?=$pil2?></td>
              <td><?=$pil3?></td>
		<td><?=$r['NamaTmp']?></td>
		
		
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