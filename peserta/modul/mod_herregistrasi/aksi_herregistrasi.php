<script type="text/javascript">
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }
</script>
<?php


session_start();
 if (empty($_SESSION['kode_briva']) AND empty($_SESSION['password'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../config/antisqlinjection.php";

$module=$_GET[module];
$act=$_GET[act];

// Update profil
if ($module=='herregistrasi' AND $act=='addreguler'){
#image upload
define ("MAX_SIZE","10024"); 
function getExtension($str)
{
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}
$errors=0;
$ijazah=$_FILES['ijazah']['name'];
if ($ijazah) 
{
	$filename = stripslashes($_FILES['ijazah']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") 
		&& ($extension != "gif")&& ($extension != "JPG") && ($extension != "JPEG") 
		&& ($extension != "PNG") && ($extension != "GIF")) 
	{
		echo '<h3>Unknown extension!</h3>';
		$errors=1;
	}
	else
	{
		$size=filesize($_FILES['ijazah']['tmp_name']);
 
		if ($size > MAX_SIZE*10024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name1=$_SESSION[kode_briva].'.'.$extension;
		$ijazah="../../ijazah/".$image_name1;
 
		$copied = copy($_FILES['ijazah']['tmp_name'], $ijazah);
		
	}
 
} 

$nem=$_FILES['nem']['name'];
if ($nem) 
{
	$filename = stripslashes($_FILES['nem']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") 
		&& ($extension != "gif")&& ($extension != "JPG") && ($extension != "JPEG") 
		&& ($extension != "PNG") && ($extension != "GIF")) 
	{
		echo '<h3>Unknown extension!</h3>';
		$errors=1;
	}
	else
	{
		$size=filesize($_FILES['nem']['tmp_name']);
 
		if ($size > MAX_SIZE*10024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name2=$_SESSION[kode_briva].'.'.$extension;
		$nem="../../nem/".$image_name2;
 
		$copied = copy($_FILES['nem']['tmp_name'], $nem);
		
	}
 
} 

$akte=$_FILES['akte']['name'];
if ($akte) 
{
	$filename = stripslashes($_FILES['akte']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") 
		&& ($extension != "gif")&& ($extension != "JPG") && ($extension != "JPEG") 
		&& ($extension != "PNG") && ($extension != "GIF")) 
	{
		echo '<h3>Unknown extension!</h3>';
		$errors=1;
	}
	else
	{
		$size=filesize($_FILES['akte']['tmp_name']);
 
		if ($size > MAX_SIZE*10024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name3=$_SESSION[kode_briva].'.'.$extension;
		$akte="../../akte/".$image_name3;
 
		$copied = copy($_FILES['akte']['tmp_name'], $akte);
		
	}
 
} 

$photo=$_FILES['photo']['name'];
if ($photo) 
{
	$filename = stripslashes($_FILES['photo']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") 
		&& ($extension != "gif")&& ($extension != "JPG") && ($extension != "JPEG") 
		&& ($extension != "PNG") && ($extension != "GIF")) 
	{
		echo '<h3>Unknown extension!</h3>';
		$errors=1;
	}
	else
	{
		$size=filesize($_FILES['photo']['tmp_name']);
 
		if ($size > MAX_SIZE*10024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name4=$_SESSION[kode_briva].'.'.$extension;
		$photo="../../photo/".$image_name4;
 
		$copied = copy($_FILES['photo']['tmp_name'], $photo);
		
	}
 
} 

$skck=$_FILES['skck']['name'];
if ($skck) 
{
	$filename = stripslashes($_FILES['skck']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") 
		&& ($extension != "gif")&& ($extension != "JPG") && ($extension != "JPEG") 
		&& ($extension != "PNG") && ($extension != "GIF")) 
	{
		echo '<h3>Unknown extension!</h3>';
		$errors=1;
	}
	else
	{
		$size=filesize($_FILES['skck']['tmp_name']);
 
		if ($size > MAX_SIZE*10024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name5=$_SESSION[kode_briva].'.'.$extension;
		$skck="../../skck/".$image_name5;
 
		$copied = copy($_FILES['skck']['tmp_name'], $skck);
		
	}
 
} 

$sp=$_FILES['sp']['name'];
if ($sp) 
{
	$filename = stripslashes($_FILES['sp']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") 
		&& ($extension != "gif")&& ($extension != "JPG") && ($extension != "JPEG") 
		&& ($extension != "PNG") && ($extension != "GIF")) 
	{
		echo '<h3>Unknown extension!</h3>';
		$errors=1;
	}
	else
	{
		$size=filesize($_FILES['sp']['tmp_name']);
 
		if ($size > MAX_SIZE*10024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name6=$_SESSION[kode_briva].'.'.$extension;
		$sp="../../sp/".$image_name6;
 
		$copied = copy($_FILES['sp']['tmp_name'], $sp);
		
	}
 
} 

$narkoba=$_FILES['narkoba']['name'];
if ($narkoba) 
{
	$filename = stripslashes($_FILES['narkoba']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") 
		&& ($extension != "gif")&& ($extension != "JPG") && ($extension != "JPEG") 
		&& ($extension != "PNG") && ($extension != "GIF")) 
	{
		echo '<h3>Unknown extension!</h3>';
		$errors=1;
	}
	else
	{
		$size=filesize($_FILES['narkoba']['tmp_name']);
 
		if ($size > MAX_SIZE*10024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name7=$_SESSION[kode_briva].'.'.$extension;
		$narkoba="../../narkoba/".$image_name7;
 
		$copied = copy($_FILES['narkoba']['tmp_name'], $narkoba);
		
	}
 
}
#Image Upload END

IF ($_SESSION[pilihan]=='POLTEKPOS'){
mysql_query("UPDATE t_herregistrasi SET ijazah='$image_name1', transkrip='$image_name2', akte='$image_name3', photo='$image_name4', skck='$image_name5', narkoba='$image_name7', surat_pernyataan='$image_name6', jasket='$_POST[jasket]' , sepatu='$_POST[sepatu]' WHERE i_registrasi='$_SESSION[kode_briva]'");

$tam = mysql_fetch_array(mysql_query("select t_herregistrasi.*, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn FROM t_herregistrasi 
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi.i_registrasi
WHERE t_herregistrasi.i_registrasi = '$_SESSION[kode_briva]' "));

IF ($tam[ijazah] == NULL) {
 $ijazah = 'cross.png';
}
ELSE{
 $ijazah = 'cek.png';
}

IF ($tam['transkrip'] == NULL) {
 $transkrip = 'cross.png';
}
ELSE{
 $transkrip = 'cek.png';
}

IF ($tam['akte'] == NULL) {
 $akte = 'cross.png';
}
ELSE{
 $akte = 'cek.png';
}

IF ($tam['photo'] == NULL) {
 $photo = 'cross.png';
}
ELSE{
 $photo = 'cek.png';
}

IF ($tam['skck'] == NULL) {
 $skck = 'cross.png';
}
ELSE{
 $skck = 'cek.png';
}

IF ($tam['narkoba'] == NULL) {
 $narkoba = 'cross.png';
}
ELSE{
 $narkoba = 'cek.png';
}

IF ($tam['surat_pernyataan'] == NULL) {
 $surat_pernyataan = 'cross.png';
}
ELSE{
 $surat_pernyataan = 'cek.png';
}

}
ELSEIF ($_SESSION[pilihan]=='STIMLOG'){
mysql_query("UPDATE t_herregistrasi_stimlog SET ijazah='$image_name1', transkrip='$image_name2', akte='$image_name3', photo='$image_name4', skck='$image_name5', narkoba='$image_name7', surat_pernyataan='$image_name6', jasket='$_POST[jasket]' , sepatu='$_POST[sepatu]' WHERE i_registrasi='$_SESSION[kode_briva]'");

$tam = mysql_fetch_array(mysql_query("select t_herregistrasi_stimlog.*, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn FROM t_herregistrasi_stimlog 
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi_stimlog.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi_stimlog.i_registrasi
WHERE t_herregistrasi_stimlog.i_registrasi = '$_SESSION[kode_briva]' "));

IF ($tam[ijazah] == NULL) {
 $ijazah = 'cross.png';
}
ELSE{
 $ijazah = 'cek.png';
}

IF ($tam['transkrip'] == NULL) {
 $transkrip = 'cross.png';
}
ELSE{
 $transkrip = 'cek.png';
}

IF ($tam['akte'] == NULL) {
 $akte = 'cross.png';
}
ELSE{
 $akte = 'cek.png';
}

IF ($tam['photo'] == NULL) {
 $photo = 'cross.png';
}
ELSE{
 $photo = 'cek.png';
}

IF ($tam['skck'] == NULL) {
 $skck = 'cross.png';
}
ELSE{
 $skck = 'cek.png';
}

IF ($tam['narkoba'] == NULL) {
 $narkoba = 'cross.png';
}
ELSE{
 $narkoba = 'cek.png';
}

IF ($tam['surat_pernyataan'] == NULL) {
 $surat_pernyataan = 'cross.png';
}
ELSE{
 $surat_pernyataan = 'cek.png';
}
}


?>

<table width="500" border="1" style="border-bottom-color:#000" align="center">
  <tr>
    <td>
 <img src="../../images/headd.png" width="500" alt=""/><BR><HR>
Nama : <?php echo "$tam[n_lengkap]"; ?> <BR>
NPM : <?php echo "$tam[npm]"; ?> <BR>
Jurusan : <?php echo "$tam[NamaJrsn]"; ?> <BR><BR>   
    
<table width="500" border="1">
  <tr>
    <td width="36"><strong>No.</strong></td>
    <td width="282"><strong>Keterangan</strong></td>
    <td width="160"><strong>Validasi</strong></td>
  </tr>
  <tr>
    <td>1.</td>
    <td>Upload Bukti Pembayaran Semester</td>
    <td><img src="../../images/cek.png" width="20" /></td>
  </tr>
  <tr>
    <td>2.</td>
    <td>Upload Ijazah SMA/SMK di Legalisir</td>
    <td><img src="../../images/<?php echo $ijazah; ?>" width="20" /></td>
  </tr>
  <tr>
    <td>3.</td>
    <td>Upload Nilai UN di Legalisir</td>
    <td><img src="../../images/<?php echo $transkrip; ?>" width="20" /></td>
  </tr>
  <tr>
    <td>4.</td>
    <td>Upload Akte Kelahiran</td>
    <td><img src="../../images/<?php echo $akte; ?>" width="20" /></td>
  </tr>
  <tr>
    <td>5.</td>
    <td>Upload Photo Terbaru</td>
    <td><img src="../../images/<?php echo $photo; ?>" width="20" /></td>
  </tr>
  <tr>
    <td>6.</td>
    <td>Upload SKCK Kepolisian/ Kelakuan Baik dari Sekolah</td>
    <td><img src="../../images/<?php echo $skck; ?>" width="20" /></td>
  </tr>
    <tr>
    <td>7.</td>
    <td>Upload Surat Keterangan Bebas Narkoba dari Kepolisian</td>
    <td><img src="../../images/<?php echo $narkoba; ?>" width="20" /></td>
  </tr>
  <tr>
    <td>8.</td>
    <td>Upload Surat Pernyataan Diatas Materai</td>
    <td><img src="../../images/<?php echo $surat_pernyataan; ?>" width="20" /></td>
  </tr>
  <tr>
    <td>9.</td>
    <td>Ukuran Jasket Almamater</td>
    <td><?php echo "$tam[jasket]"; ?></td>
  </tr>
  <tr>
    <td>10.</td>
    <td>Ukuran Sepatu</td>
    <td><?php echo "$tam[sepatu]"; ?></td>
  </tr>	
</table>
<small><p>Keterangan : <img src="../../images/cek.png" width="20" /> Sudah <img src="../../images/cross.png" width="20" /> Belum.</p></small>
<p> Bandung, <?php echo date("d/m/Y"); ?></p>
<p>&nbsp;</p>
<p><strong><?php echo "$tam[validator]"; ?></strong>.</p>    
    
    
    </td>
  </tr>
</table>
<BR>
<?php
echo "<center><input id='printpagebutton' type='button' value='Cetak Bukti Registrasi' onclick='printpage()'/>Untuk Kembali klik <a href=../../media.php?module=$module><em>disini</em></a></center>";

}
}
?>
