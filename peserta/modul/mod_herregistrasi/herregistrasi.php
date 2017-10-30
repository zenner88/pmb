<?php
session_start();
include "../config/koneksi.php";
include "config/recaptchalib.php";
$publickey = "6Le8Tr4SAAAAAOwlk7qk8eZJ7i2gzWRXfK7r420n";
$privatekey = "6Le8Tr4SAAAAAEpek74I8a--2ZC5j09NPQfCk1Ux";
 if (empty($_SESSION['kode_briva']) AND empty($_SESSION['password'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_herregistrasi/aksi_herregistrasi.php";
switch($_GET[act]){
  // Tampil Komentar
  default:

$tam = mysql_fetch_array(mysql_query("select t_herregistrasi.*, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn FROM t_herregistrasi 
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi.i_registrasi
WHERE t_herregistrasi.i_registrasi = '$_SESSION[kode_briva]'
union
select t_herregistrasi_stimlog.*, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn FROM t_herregistrasi_stimlog 
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi_stimlog.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi_stimlog.i_registrasi
WHERE t_herregistrasi_stimlog.i_registrasi = '$_SESSION[kode_briva]'"));

?> 
<div class="panel panel-primary">
        <div class="panel-heading">
                              
			<b>
	                  Her-Registrasi Mahasiswa Baru <?php echo"$_SESSION[kode_briva] - $tam[n_lengkap] ($tam[npm])";?></b>		  
        </div>
                          
    <div class="panel-footer">
                                  
<form name="form1" method="post" enctype="multipart/form-data" action="<?php echo "$aksi?module=herregistrasi&act=addreguler"; ?>"> 
<table class="table table-bordered " width="550" cellpadding="4">
<?php
if ($tam[ijazah]=='')
{
echo"<tr>
<td width='50%' class='alert-info'><span class='style'><b>Photocopy Ijazah SMA/SMK (Legalisir)</span></b</td>
<td class='bg-warning'><input name='ijazah' size='40' maxlength='255' type='file' class='required'>
</tr>";
}
else
{
echo"<tr>
<td width='50%' class='alert-info'><span class='style'><b>Photocopy Ijazah SMA/SMK (Legalisir)</span></b</td>
<td class='bg-warning'>Lengkap
</tr>";
}

if ($tam[transkrip]=='')
{
echo"<tr>
<td class='alert-info'><b>Photocopy Daftar NEM/UN (Legalisir)</b></td>
<td class='bg-warning'><input name='nem' size='40' maxlength='255' type='file' class='required'>
</tr>";
}
else
{
echo"<tr>
<td class='alert-info'><b>Photocopy Daftar NEM/UN (Legalisir)</b></td>
<td class='bg-warning'>Lengkap
</tr>";
}

if ($tam[akte]=='')
{
echo"<tr>
<td class='alert-info'><b>Photocopy Akte Kelahiran</b></td>
<td class='bg-warning'><input name='akte' size='40' maxlength='255' type='file' class='required'>
</tr>";
}
else
{
echo"<tr>
<td class='alert-info'><b>Photocopy Akte Kelahiran</b></td>
<td class='bg-warning'>Lengkap
</tr>";
}

if ($tam[photo]=='')
{
echo"<tr>
<td class='alert-info'><b>Pas Photo (Terbaru)</td>
<td class='bg-warning'><input name='photo' size='40' maxlength='255' type='file' class='required'>
</tr>";
}
else
{
echo"<tr>
<td class='alert-info'><b>Pas Photo (Terbaru)</b></td>
<td class='bg-warning'>Lengkap
</tr>";
}

if ($tam[skck]=='')
{
echo"<tr>
<td class='alert-info'><b>SKCK dari Kepolisian/ Surat Kelakuan Baik Dari Sekolah</td>
<td class='bg-warning'><input name='skck' size='40' maxlength='255' type='file' class='required'>
</tr>";
}
else
{
echo"<tr>
<td class='alert-info'><b>SKCK dari Kepolisian/ Surat Kelakuan Baik Dari Sekolah</b></td>
<td class='bg-warning'>Lengkap
</tr>";
}

if ($tam[narkoba]=='')
{
echo"<tr>
<td class='alert-info'><b>Surat Keterangan Bebas Narkoba dari Kepolisian</b></td>
<td class='bg-warning'><input name='narkoba' size='40' maxlength='255' type='file' class='required'>
</tr>";
}
else
{
echo"<tr>
<td class='alert-info'><b>Surat Keterangan Bebas Narkoba dari Kepolisian</b></td>
<td class='bg-warning'>Lengkap
</tr>";
}

if ($tam[surat_pernyataan]=='')
{
echo"<tr>
<td class='alert-info'><b>Surat Pernyataan (diatas Materai)</td>
<td class='bg-warning'><input name='sp' size='40' maxlength='255' type='file' class='required'>
</tr>";
}
else
{
echo"<tr>
<td class='alert-info'><b>Surat Pernyataan (diatas Materai)</b></td>
<td class='bg-warning'>Lengkap
</tr>";
}

if ($tam[jasket]=='')
{
echo"<tr>
<td class='alert-info'><b>Ukuran Jaket/ Almamater</b></td>
<td class='bg-warning'> 
  <select name='jasket' id='select'>
    <option selected='selected'>S</option>
    <option>M</option>
    <option>L</option>
    <option>XL</option>
    <option>XXL</option>
    <option>DII</option>
  </select>
</tr>";
}
else
{
echo"<tr>
<td class='alert-info'><b>Ukuran Jaket/ Almamater</b></td>
<td class='bg-warning'>$tam[jasket]
</tr>";
}

if ($tam[sepatu]=='')
{
echo"<tr>
<td class='alert-info'><b>Ukuran Sepatu (POLTEKPOS)</b></td>
<td class='bg-warning'>
  <select name='sepatu' id='select'>
    <option selected='selected'>36</option>
    <option>37</option>
    <option>38</option>
    <option>39</option>
    <option>40</option>
    <option>41</option>
    <option>42</option>
    <option>43</option>
    <option>44</option>
  </select>
</tr>";
}
else
{
echo"<tr>
<td class='alert-info'><b>Ukuran Sepatu (POLTEKPOS)</b></td>
<td class='bg-warning'>$tam[sepatu]
</tr>";
}

?>



<tr>
<td colspan="2" align="center">
<input type="submit" name="Submit" value="Simpan" class="btn btn-primary">
</td>
</tr>
</table>
</form>  
</div>

</div>
        <div class="clearfix"></div>	
<?php
    break;
}
}
?>
