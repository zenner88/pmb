<?php
include '../../../config/koneksi.php';
		$tampil = mysql_query("SELECT t_calon_mahasiswa.*,t_daftar.* from t_calon_mahasiswa
              inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi
					WHERE t_calon_mahasiswa.i_registrasi='$_POST[id]'");
		$r = mysql_fetch_array($tampil);
$cekbayar=mysql_fetch_array(mysql_query("SELECT t_herregistrasi.*, t_jurusan.NamaJrsn FROM t_herregistrasi 
inner join t_jurusan on t_jurusan.KodeJrsn =t_herregistrasi.id_jur where t_herregistrasi.i_registrasi='$_GET[id]'
union
SELECT t_herregistrasi_stimlog.*, t_jurusan.NamaJrsn FROM t_herregistrasi_stimlog 
inner join t_jurusan on t_jurusan.KodeJrsn =t_herregistrasi_stimlog.id_jur where
t_herregistrasi_stimlog.i_registrasi='$_POST[id]'"));

$tam=mysql_fetch_array(mysql_query("select t_herregistrasi.*, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn FROM t_herregistrasi 
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi.i_registrasi
WHERE t_herregistrasi.i_registrasi = '$_POST[id]'
union
select t_herregistrasi_stimlog.*, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn FROM t_herregistrasi_stimlog 
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi_stimlog.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi_stimlog.i_registrasi
WHERE t_herregistrasi_stimlog.i_registrasi = '$_POST[id]'"));

IF ($tam[ijazah] == NULL) {
 $ijazah = 'X';
}
ELSE{
 $ijazah = 'V';
}

IF ($tam['transkrip'] == NULL) {
 $transkrip = 'X';
}
ELSE{
 $transkrip = 'V';
}

IF ($tam['akte'] == NULL) {
 $akte = 'X';
}
ELSE{
 $akte = 'V';
}

IF ($tam['photo'] == NULL) {
 $photo = 'X';
}
ELSE{
 $photo = 'V';
}

IF ($tam['skck'] == NULL) {
 $skck = 'X';
}
ELSE{
 $skck = 'V';
}

IF ($tam['surat_pernyataan'] == NULL) {
 $surat_pernyataan = 'X';
}
ELSE{
 $surat_pernyataan = 'V';
}

?>
<table width="900" border="1" style="border-bottom-color:#000" align="center">
  <tr>
    <td>
 <img src="../../images/headd.png" width="900" alt=""/><BR><HR>
Nama : <?php echo "$tam[n_lengkap]"; ?> <BR>
NPM : <?php echo "$tam[npm]"; ?> <BR>
Jurusan : <?php echo "$tam[NamaJrsn]"; ?> <BR><BR>   
    
<table width="900" border="1">
  <tr>
    <td width="36"><strong>No.</strong></td>
    <td width="282"><strong>Keterangan</strong></td>
    <td width="160"><strong>Validasi</strong></td>
  </tr>
  <tr>
    <td>1.</td>
    <td>Upload Bukti Pembayaran Semester</td>
    <td> V - <?php echo "$tam[status_bayar]"; ?></td>
  </tr>
  <tr>
    <td>2.</td>
    <td>Upload Ijazah SMA/SMK di Legalisir</td>
    <td><?php echo $ijazah; ?></td>
  </tr>
  <tr>
    <td>3.</td>
    <td>Upload Nilai UN di Legalisir</td>
    <td><?php echo $transkrip; ?></td>
  </tr>
  <tr>
    <td>4.</td>
    <td>Upload Akte Kelahiran</td>
    <td><?php echo $akte; ?></td>
  </tr>
  <tr>
    <td>5.</td>
    <td>Upload Photo Terbaru</td>
    <td><?php echo $photo; ?></td>
  </tr>
  <tr>
    <td>6.</td>
    <td>Upload SKCK Kepolisian/ Kelakuan Baik dari Sekolah</td>
    <td><?php echo $skck; ?></td>
  </tr>
  <tr>
    <td>7.</td>
    <td>Upload Surat Pernyataan Diatas Materai</td>
    <td><?php echo $surat_pernyataan; ?></td>
  </tr>
  <tr>
    <td>8.</td>
    <td>Ukuran Jasket Almamater</td>
    <td><?php echo "$tam[jasket]"; ?></td>
  </tr>
  <tr>
    <td>9.</td>
    <td>Ukuran Sepatu</td>
    <td><?php echo "$tam[sepatu]"; ?></td>
  </tr>	
</table>
<small><p>Keterangan : V Sudah X Belum.</p></small>
<p> Bandung, <?php echo date("d/m/Y"); ?></p>
<p>&nbsp;</p>
<p><strong><?php echo "$tam[validator]"; ?></strong>.</p>    
    
    
    </td>
  </tr>
</table>

