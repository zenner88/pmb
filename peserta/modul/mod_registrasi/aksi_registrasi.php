<?php
error_reporting(0);
session_start();
 if (empty($_SESSION['kode_briva']) AND empty($_SESSION['password'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../config/antisqlinjection.php";
?>
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
$module=$_GET[module];
$act=$_GET[act];

// Update profil
if ($module=='registrasi' AND $act=='addreguler'){
//if($_POST['pin'] and $_POST['i_thn_akademik'] and $_POST['c_gel'] and $_POST['n_lengkap'] and $_POST['n_jns_kelamin'] and $_POST['n_temp_lahir'] and $_POST['d_lahir'] and $_POST['n_alamat'] and $_POST['n_kabupaten'] and $_POST['n_propinsi'] and $_POST['c_pos'] and $_POST['i_telp'] and $_POST['i_hp'] and $_POST['n_email'] and $_POST['n_ortu'] and $_POST['n_jabatan'] and $_POST['n_sma'] and $_POST['i_jur_sma'] and $_POST['n_alamat_sma'] and $_POST['n_kab_sma']and $_POST['n_prop_sma'] and $_POST['n_pil1'] and $_POST['n_pil2'] and $_POST['n_pil3'] and $_POST['i_temp_ujian'] and $_POST['c_inf'] and $_POST['q_sdp2'] and $_POST['c_jalur'])
//{
$i_registrasi=$_POST['pin'];
$i_thn_akademik=$_POST['i_thn_akademik'];
$c_gel=$_POST['c_gel'];
$n_lengkap=$_POST['n_lengkap'];
$n_jns_kelamin=$_POST['n_jns_kelamin'];
$n_temp_lahir=$_POST['n_temp_lahir'];
$d_lahir=$_POST['d_lahir'];
$n_alamat=$_POST['n_alamat'];
$n_kabupaten=$_POST['n_kabupaten'];
$n_propinsi=$_POST['n_propinsi'];
//$n_kota_lain=$_POST['n_kota_lain'];
$c_pos=$_POST['c_pos'];
$i_telp=$_POST['i_telp'];
$i_hp=$_POST['i_hp'];
$n_email=$_POST['n_email'];
$n_ortu=$_POST['n_ortu'];
$n_ibu=$_POST['n_ibu'];
//$n_instansi=$_POST['n_instansi'];
$n_jabatan=$_POST['n_jabatan'];
$nis=$_POST['nis'];
$n_sma=$_POST['n_sma'];
$i_jur_sma=$_POST['i_jur_sma'];
$n_alamat_sma=$_POST['n_alamat_sma'];
$n_kab_sma=$_POST['n_kab_sma'];
$n_prop_sma=$_POST['n_prop_sma'];
$n_pil1=$_POST['n_pil1'];
$n_pil2=$_POST['n_pil2'];
$n_pil3=$_POST['n_pil3'];
$i_temp_ujian=$_POST['i_temp_ujian'];
$c_inf=$_POST['c_inf'];
//$q_sdp2=$_POST['q_sdp2'];
//$e_prestasi=$_POST['e_prestasi'];
$c_jalur=$_POST['c_jalur'];
//$i_foto = $_POST['photo'];
$i_agama = $_POST['i_agama'];

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
$image=$_FILES['photo']['name'];
if ($image) 
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
 
		if ($size > MAX_SIZE*400000)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name=$_POST['pin'].'.'.$extension;
		$newname="../../foto/".$image_name;
 
		$copied = copy($_FILES['photo']['tmp_name'], $newname);
		
	}
 
}

replace_meta_chars(mysql_query("insert into t_calon_mahasiswa (i_registrasi,i_thn_akademik,c_gel,n_lengkap,n_jns_kelamin,n_temp_lahir,d_lahir,n_alamat,n_kabupaten,n_propinsi,
c_pos,i_telp,i_hp,n_email,n_ortu,n_ibu,n_jabatan,nis,n_sma,i_jur_sma,n_alamat_sma,n_kab_sma,n_prop_sma,n_pil1,n_pil2,
n_pil3,i_temp_ujian,c_inf,c_jalur,status,metode,n_agama,photo) values('$i_registrasi','$i_thn_akademik','$c_gel','$n_lengkap','$n_jns_kelamin','$n_temp_lahir','$d_lahir','$n_alamat','$n_kabupaten','$n_propinsi','$c_pos','$i_telp','$i_hp','$n_email','$n_ortu','$n_ibu','$n_jabatan','$nis','$n_sma','$i_jur_sma',
'$n_alamat_sma','$n_kab_sma','$n_prop_sma','$n_pil1','$n_pil2','$n_pil3','$i_temp_ujian','$c_inf','$c_jalur','Registrasi','online','$i_agama','$image_name')"));
replace_meta_chars(mysql_query("UPDATE t_pin SET `status` = 'aktif' WHERE t_pin.pin ='$i_registrasi' LIMIT 1 ;"));

$sql_tampil="select t_calon_mahasiswa.*,t_gel.namagel as nama_gel,t_gel.jalur as jalur,t_tempat_ujian.namatmp as temp_ujian from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel inner join t_tempat_ujian on t_calon_mahasiswa.i_temp_ujian=t_tempat_ujian.kodetmp where t_calon_mahasiswa.i_registrasi='$i_registrasi'";
  $query_tampil=mysql_query($sql_tampil,$koneksi);
  $row_tampil=mysql_fetch_array($query_tampil);
	//D3
	//pil 1
	if ($row_tampil[n_pil1] =='01')
	{
		$pil1 = "D3 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil1] =='02')
	{
			$pil1 = "D3 - Manajemen Bisnis";
	}
	if ($row_tampil[n_pil1] =='03')
	{
		$pil1 = "D3 - Manajemen Informatika";
	}
	
	if($row_tampil[n_pil1] =='04')
	{
			$pil1 = "D3 - Teknik Informatika";
	}
	if($row_tampil[n_pil1] =='05')
	{
			$pil1 = "D3 - Akuntansi";
	}
	if($row_tampil[n_pil1] =='21')
	{
			$pil1 = "S1 - Manajemen Logistik";
	}
	if($row_tampil[n_pil1] =='22')
	{
			$pil1 = "S1 - Manajemen Transportasi";
	}
       
       if($row_tampil[n_pil1] =='31')
	{
			$pil1 = "D3 - Akselerasi Teknik Informatika";
	}
	if($row_tampil[n_pil1] =='32')
	{
			$pil1 = "D3 - Akselerasi Akuntansi";
	}
	
	if($row_tampil[n_pil1] =='34')
	{
			$pil1 = "D4 - CLC (Akselerasi Logistik Bisnis)";
	}
	if($row_tampil[n_pil1] =='35')
	{
			$pil1 = "D4 - CAC (Akselerasi Akuntansi)";
	}

	//---pil 2
	if ($row_tampil[n_pil2] =='01')
	{
		$pil2 = "D3 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil2] =='02')
	{
			$pil2 = "D3 - Manajemen Bisnis";
	}
	if ($row_tampil[n_pil2] =='03')
	{
		$pil2 = "D3 - Manajemen Informatika";
	}
	
	if($row_tampil[n_pil2] =='04')
	{
			$pil2 = "D3 - Teknik Informatika";
	}
	if($row_tampil[n_pil2] =='05')
	{
			$pil2 = "D3 - Akuntansi";
	}
	if($row_tampil[n_pil2] =='21')
	{
			$pil2 = "S1 - Manajemen Logistik";
	}
	if($row_tampil[n_pil2] =='22')
	{
			$pil2 = "S1 - Manajemen Transportasi";
	}

      if($row_tampil[n_pil2] =='31')
	{
			$pil2 = "D3 - Akselerasi Teknik Informatika";
	}
	if($row_tampil[n_pil2] =='32')
	{
			$pil2 = "D3 - Akselerasi Akuntansi";
	}
	
	if($row_tampil[n_pil2] =='34')
	{
			$pil2 = "D4 - CLC (Akselerasi Logistik Bisnis)";
	}
	if($row_tampil[n_pil2] =='35')
	{
			$pil2 = "D4 - CAC (Akselerasi Akuntansi)";
	}

	//-- pil 3
	if ($row_tampil[n_pil3] =='01')
	{
		$pil3 = "D3 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil3] =='02')
	{
			$pil3 = "D3 - Manajemen Bisnis";
	}
	if ($row_tampil[n_pil3] =='03')
	{
		$pil3 = "D3 - Manajemen Informatika";
	}
	
	if($row_tampil[n_pil3] =='04')
	{
			$pil3 = "D3 - Teknik Informatika";
	}
	if($row_tampil[n_pil3] =='05')
	{
			$pil3 = "D3 - Akuntansi";
	}
	if($row_tampil[n_pil3] =='21')
	{
			$pil3 = "S1 - Manajemen Logistik";
	}
	if($row_tampil[n_pil3] =='22')
	{
			$pil3 = "S1 - Manajemen Transportasi";
	}

	if($row_tampil[n_pil3] =='31')
	{
			$pil3 = "D3 - Akselerasi Teknik Informatika";
	}
	if($row_tampil[n_pil3] =='32')
	{
			$pil3 = "D3 - Akselerasi Akuntansi";
	}
	
	if($row_tampil[n_pil3] =='34')
	{
			$pil3 = "D4 - CLC (Akselerasi Logistik Bisnis)";
	}
	if($row_tampil[n_pil3] =='35')
	{
			$pil3 = "D4 - CAC (Akselerasi Akuntansi)";
	}

	//D4
	//pil 1
	if ($row_tampil[n_pil1] =='11')
	{
		$pil1 = "D4 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil1] =='12')
	{
			$pil1 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($row_tampil[n_pil1] =='13')
	{
		$pil1 = "D4 - Teknik Informatika";
	}
	
	if($row_tampil[n_pil1] =='14')
	{
			$pil1 = "D4 - Akuntansi Keuangan";
	}
	//---pil 2
	if ($row_tampil[n_pil2] =='11')
	{
		$pil2 = "D4 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil2] =='12')
	{
			$pil2 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($row_tampil[n_pil2] =='13')
	{
		$pil2 = "D4 - Teknik Informatika";
	}
	
	if($row_tampil[n_pil2] =='14')
	{
			$pil2 = "D4 - Akuntansi Keuangan";
	}
	//-- pil 3
	if ($row_tampil[n_pil3] =='11')
	{
		$pil3 = "D4 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil3] =='12')
	{
			$pil3 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($row_tampil[n_pil3] =='13')
	{
		$pil3 = "D4 - Teknik Informatika";
	}
	
	if($row_tampil[n_pil3] =='14')
	{
			$pil3 = "D4 - Akuntansi Keuangan";
	}



	echo "<table width='100%' border='0'>
  <tr>
   &nbsp
  </tr>
  <tr>
    <center><h1>BUKTI PENDAFTARAN ONLINE MAHASISWA BARU <br>
POLTEKPOS & STIMLOG
<h1></center>
  </tr>
  <tr>
   &nbsp
  </tr>
  <tr>
    <td colspan='3'><B>DATA PENDAFTAR</B></td>
  </tr>
  <tr>
    <td width='5%'>No Pendaftaran </td>
    <td width='1%'>:</td>
    <td>$row_tampil[0]</td>
  </tr>
  <tr>
    <td width='20%'>Nama Peserta </td>
    <td width='1%'>:</td>
    <td width='92%'>$row_tampil[3]</td>
  </tr>
  <tr>
    <td width='20%'>NISN</td>
    <td width='1%'>:</td>
    <td width='92%'>$row_tampil[nis]</td>
  </tr>
  <tr>
    <td width='20%'>Email</td>
    <td width='1%'>:</td>
    <td width='92%'>$row_tampil[n_email]</td>
  </tr>
  <tr>
    <td>Jalur</td>
    <td>:</td>
    <td>$row_tampil[jalur] - $row_tampil[nama_gel]</td>
  </tr>
  <tr>
    <td colspan='3'><B>PILIHAN PROGRAM STUDI</B></td>
  </tr>
  <tr>
    <td>Pilihan 1 </td>
    <td>:</td>
    <td>$pil1</td>
  </tr>
  <tr>
    <td>Pilihan 2 </td>
    <td>:</td>
    <td>$pil2</td>
  </tr>
  <tr>
    <td>Pilihan 3 </td>
    <td>:</td>
    <td>$pil3</td>
  </tr>
  <tr>
    <td colspan='3'><b>INFO LEBIH LANJUT HUBUNGI</b> : 
<ul>
<li>
Sekretariat PMB Poltekpos-Stimlog<br />
Jl. Sariasih No.54 Bandung 40151<br />
Tlp: 022-2009562, 022-61693672, 022-93250092, Fax : 022-2011089<br />
E-mail : info@poltekpos.ac.id,pmb@poltekpos.ac.id<br />
http//: pmb.poltekpos.ac.id</li>
</ul>			
</td>
  </tr>
</table>
";

//}
  //header('location:../../media.php?module='.$module);
  echo "<center><input TYPE='button' onClick='window.print()' value='Cetak Bukti Pendaftaran'> Untuk Kembali klik <a href=../../media.php?module=$module><em>disini</em></a></center>";

}
if ($module=='registrasi' AND $act=='addpmdk'){
//if($_POST['pin'] and $_POST['i_thn_akademik'] and $_POST['c_gel'] and $_POST['n_lengkap'] and $_POST['n_jns_kelamin'] and $_POST['n_temp_lahir'] and $_POST['d_lahir'] and $_POST['n_alamat'] and $_POST['n_kabupaten'] and $_POST['n_propinsi'] and $_POST['c_pos'] and $_POST['i_telp'] and $_POST['i_hp'] and $_POST['n_email'] and $_POST['n_ortu'] and $_POST['n_instansi'] and $_POST['n_jabatan'] and $_POST['n_sma'] and $_POST['i_jur_sma'] and $_POST['n_alamat_sma'] and $_POST['n_kab_sma']and $_POST['n_prop_sma'] and $_POST['n_pil1'] and $_POST['n_pil2'] and $_POST['n_pil3'] and $_POST['i_temp_ujian'] and $_POST['c_inf'] and $_POST['q_sdp2'] and $_POST['e_prestasi'] and $_POST['c_jalur'])
//{
$i_registrasi=$_POST['pin'];
$i_thn_akademik=$_POST['i_thn_akademik'];
$c_gel=$_POST['c_gel'];
$n_lengkap=$_POST['n_lengkap'];
$n_jns_kelamin=$_POST['n_jns_kelamin'];
$n_temp_lahir=$_POST['n_temp_lahir'];
$d_lahir=$_POST['d_lahir'];
$n_alamat=$_POST['n_alamat'];
$n_kabupaten=$_POST['n_kabupaten'];
$n_propinsi=$_POST['n_propinsi'];
$n_kota_lain=$_POST['n_kota_lain'];
$c_pos=$_POST['c_pos'];
$i_telp=$_POST['i_telp'];
$i_hp=$_POST['i_hp'];
$n_email=$_POST['n_email'];
$n_ortu=$_POST['n_ortu'];
$n_ibu=$_POST['n_ibu'];
$n_instansi=$_POST['n_instansi'];
$n_jabatan=$_POST['n_jabatan'];
$nis=$_POST['nis'];
$n_sma=$_POST['n_sma'];
$i_jur_sma=$_POST['i_jur_sma'];
$n_alamat_sma=$_POST['n_alamat_sma'];
$n_kab_sma=$_POST['n_kab_sma'];
$n_prop_sma=$_POST['n_prop_sma'];
$n_pil1=$_POST['n_pil1'];
$n_pil2=$_POST['n_pil2'];
$n_pil3=$_POST['n_pil3'];
$q_sdp2=$_POST['q_sdp2'];
$e_prestasi=$_POST['e_prestasi'];
$rata2_XI_2=$_POST['rata2_XI_2'];
$mtk_XI_2=$_POST['mtk_XI_2'];
$ing_XI_2=$_POST['ing_XI_2'];
$rata2_XII_1=$_POST['rata2_XII_1'];
$mtk_XII_1=$_POST['mtk_XII_1'];
$ing_XII_1=$_POST['ing_XII_1'];
$c_jalur=$_POST['c_jalur'];
$i_foto = $_POST['photo'];
$i_agama = $_POST['i_agama'];

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
$image=$_FILES['photo']['name'];
if ($image) 
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
 
		$image_name=$_POST['pin'].'.'.$extension;
		$newname="../../foto/".$image_name;
 
		$copied = copy($_FILES['photo']['tmp_name'], $newname);
		
	}
 
}



$smt11=$_FILES['smt11']['name'];
if ($smt11) 
{
	$filename = stripslashes($_FILES['smt11']['name']);
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
		$size=filesize($_FILES['smt11']['tmp_name']);
 
		if ($size > MAX_SIZE*20024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name2=$_POST['pin'].'.'.$extension;
		$smt11="../../smt11/".$image_name2;
 
		$copied = copy($_FILES['smt11']['tmp_name'], $smt11);
		
	}
 
}

$smt12=$_FILES['smt12']['name'];
if ($smt12) 
{
	$filename = stripslashes($_FILES['smt12']['name']);
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
		$size=filesize($_FILES['smt12']['tmp_name']);
 
		if ($size > MAX_SIZE*20024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name3=$_POST['pin'].'.'.$extension;
		$smt12="../../smt12/".$image_name3;
 
		$copied = copy($_FILES['smt12']['tmp_name'], $smt12);
		
	}
 
}



replace_meta_chars(mysql_query("insert into t_calon_mahasiswa (i_registrasi,i_thn_akademik,c_gel,n_lengkap,n_jns_kelamin,n_temp_lahir,d_lahir,n_alamat,n_kabupaten,n_propinsi,n_kota_lain,c_pos,i_telp,
i_hp,n_email,n_ortu,n_ibu,n_jabatan,nis,n_sma,i_jur_sma,
n_alamat_sma,n_kab_sma,n_prop_sma,n_pil1,n_pil2,
n_pil3,i_temp_ujian,c_inf,q_sdp2,e_prestasi,c_jalur,status,metode,n_agama,photo,smt11,smt12) values('$i_registrasi','$i_thn_akademik','$c_gel','$n_lengkap','$n_jns_kelamin','$n_temp_lahir','$d_lahir','$n_alamat','$n_kabupaten','$n_propinsi','-','$c_pos','$i_telp',
'$i_hp','$n_email','$n_ortu','$n_ibu','$n_jabatan','$nis','$n_sma','$i_jur_sma',
'$n_alamat_sma','$n_kab_sma','$n_prop_sma','$n_pil1','$n_pil2',
'$n_pil3','-','-','-','-','$c_jalur','Registrasi','online','$i_agama','$image_name','$image_name2','$image_name3')"));
replace_meta_chars(mysql_query("UPDATE t_pin SET status = 'aktif' WHERE t_pin.pin ='$i_registrasi' LIMIT 1 ;"));

$sql_tampil="select t_calon_mahasiswa.*,t_gel.namagel as nama_gel from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel where t_calon_mahasiswa.i_registrasi='$i_registrasi'";
  $query_tampil=mysql_query($sql_tampil,$koneksi);
  $row_tampil=mysql_fetch_array($query_tampil);

	//D3
	//pil 1
	if ($row_tampil[n_pil1] =='01')
	{
		$pil1 = "D3 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil1] =='02')
	{
			$pil1 = "D3 - Manajemen Bisnis";
	}
	if ($row_tampil[n_pil1] =='03')
	{
		$pil1 = "D3 - Manajemen Informatika";
	}
	
	if($row_tampil[n_pil1] =='04')
	{
			$pil1 = "D3 - Teknik Informatika";
	}
	if($row_tampil[n_pil1] =='05')
	{
			$pil1 = "D3 - Akuntansi";
	}
	if($row_tampil[n_pil1] =='21')
	{
			$pil1 = "S1 - Manajemen Logistik";
	}
	if($row_tampil[n_pil1] =='22')
	{
			$pil1 = "S1 - Manajemen Transportasi";
	}
       
       if($row_tampil[n_pil1] =='31')
	{
			$pil1 = "D3 - Akselerasi Teknik Informatika";
	}
	if($row_tampil[n_pil1] =='32')
	{
			$pil1 = "D3 - Akselerasi Akuntansi";
	}
	
	if($row_tampil[n_pil1] =='34')
	{
			$pil1 = "D4 - CLC (Akselerasi Logistik Bisnis)";
	}
	if($row_tampil[n_pil1] =='35')
	{
			$pil1 = "D4 - CAC (Akselerasi Akuntansi)";
	}

	//---pil 2
	if ($row_tampil[n_pil2] =='01')
	{
		$pil2 = "D3 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil2] =='02')
	{
			$pil2 = "D3 - Manajemen Bisnis";
	}
	if ($row_tampil[n_pil2] =='03')
	{
		$pil2 = "D3 - Manajemen Informatika";
	}
	
	if($row_tampil[n_pil2] =='04')
	{
			$pil2 = "D3 - Teknik Informatika";
	}
	if($row_tampil[n_pil2] =='05')
	{
			$pil2 = "D3 - Akuntansi";
	}
	if($row_tampil[n_pil2] =='21')
	{
			$pil2 = "S1 - Manajemen Logistik";
	}
	if($row_tampil[n_pil2] =='22')
	{
			$pil2 = "S1 - Manajemen Transportasi";
	}

      if($row_tampil[n_pil2] =='31')
	{
			$pil2 = "D3 - Akselerasi Teknik Informatika";
	}
	if($row_tampil[n_pil2] =='32')
	{
			$pil2 = "D3 - Akselerasi Akuntansi";
	}
	
	if($row_tampil[n_pil2] =='34')
	{
			$pil2 = "D4 - CLC (Akselerasi Logistik Bisnis)";
	}
	if($row_tampil[n_pil2] =='35')
	{
			$pil2 = "D4 - CAC (Akselerasi Akuntansi)";
	}

	//-- pil 3
	if ($row_tampil[n_pil3] =='01')
	{
		$pil3 = "D3 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil3] =='02')
	{
			$pil3 = "D3 - Manajemen Bisnis";
	}
	if ($row_tampil[n_pil3] =='03')
	{
		$pil3 = "D3 - Manajemen Informatika";
	}
	
	if($row_tampil[n_pil3] =='04')
	{
			$pil3 = "D3 - Teknik Informatika";
	}
	if($row_tampil[n_pil3] =='05')
	{
			$pil3 = "D3 - Akuntansi";
	}
	if($row_tampil[n_pil3] =='21')
	{
			$pil3 = "S1 - Manajemen Logistik";
	}
	if($row_tampil[n_pil3] =='22')
	{
			$pil3 = "S1 - Manajemen Transportasi";
	}

	if($row_tampil[n_pil3] =='31')
	{
			$pil3 = "D3 - Akselerasi Teknik Informatika";
	}
	if($row_tampil[n_pil3] =='32')
	{
			$pil3 = "D3 - Akselerasi Akuntansi";
	}
	
	if($row_tampil[n_pil3] =='34')
	{
			$pil3 = "D4 - CLC (Akselerasi Logistik Bisnis)";
	}
	if($row_tampil[n_pil3] =='35')
	{
			$pil3 = "D4 - CAC (Akselerasi Akuntansi)";
	}

	//D4
	//pil 1
	if ($row_tampil[n_pil1] =='11')
	{
		$pil1 = "D4 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil1] =='12')
	{
			$pil1 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($row_tampil[n_pil1] =='13')
	{
		$pil1 = "D4 - Teknik Informatika";
	}
	
	if($row_tampil[n_pil1] =='14')
	{
			$pil1 = "D4 - Akuntansi Keuangan";
	}
	//---pil 2
	if ($row_tampil[n_pil2] =='11')
	{
		$pil2 = "D4 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil2] =='12')
	{
			$pil2 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($row_tampil[n_pil2] =='13')
	{
		$pil2 = "D4 - Teknik Informatika";
	}
	
	if($row_tampil[n_pil2] =='14')
	{
			$pil2 = "D4 - Akuntansi Keuangan";
	}
	//-- pil 3
	if ($row_tampil[n_pil3] =='11')
	{
		$pil3 = "D4 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil3] =='12')
	{
			$pil3 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($row_tampil[n_pil3] =='13')
	{
		$pil3 = "D4 - Teknik Informatika";
	}
	
	if($row_tampil[n_pil3] =='14')
	{
			$pil3 = "D4 - Akuntansi Keuangan";
	}



	echo "<table width='100%' border='0'>
  <tr>
   &nbsp
  </tr>
  <tr>
    <center><h1>BUKTI PENDAFTARAN ONLINE MAHASISWA BARU <br>
POLTEKPOS & STIMLOG<h1></center>
  </tr>
  <tr>
   &nbsp
  </tr>
  <tr>
    <td colspan='3'><B>DATA PENDAFTAR</B></td>
  </tr>
  <tr>
    <td width='5%'>No Pendaftaran </td>
    <td width='1%'>:</td>
    <td>$row_tampil[0]</td>
  </tr>
  <tr>
    <td width='20%'>Nama Peserta </td>
    <td width='1%'>:</td>
    <td width='92%'>$row_tampil[3]</td>
  </tr>
  <tr>
    <td width='20%'>NISN</td>
    <td width='1%'>:</td>
    <td width='92%'>$row_tampil[nis]</td>
  </tr>
  <tr>
    <td width='20%'>Email</td>
    <td width='1%'>:</td>
    <td width='92%'>$row_tampil[n_email]</td>
  </tr>
  <tr>
    <td>Jalur</td>
    <td>:</td>
    <td>$row_tampil[nama_gel]</td>
  </tr>
  <tr>
    <td colspan='3'><B>PILIHAN PROGRAM STUDI</B></td>
  </tr>
  <tr>
    <td>Pilihan 1 </td>
    <td>:</td>
    <td>$pil1</td>
  </tr>
  <tr>
    <td>Pilihan 2 </td>
    <td>:</td>
    <td>$pil2</td>
  </tr>
  <tr>
    <td>Pilihan 3 </td>
    <td>:</td>
    <td>$pil3</td>
  </tr>
  <tr>
    <td colspan='3'><b>INFO LEBIH LANJUT HUBUNGI</b> : 
<ul>
<li>
Sekretariat PMB Poltekpos-Stimlog<br />
Jl. Sariasih No.54 Bandung 40151<br />
Tlp: 022-2009562, 022-61693672, 022-93250092, Fax : 022-2011089<br />
E-mail : info@poltekpos.ac.id / pmb.stimlog.ac.id<br />
http//: pmb.poltekpos.ac.id</li>
</ul>			
</td>
  </tr>
</table>
";

//}
  //header('location:../../media.php?module='.$module);
  echo "<center><input id='printpagebutton' type='button' value='Cetak Bukti Registrasi' onclick='printpage()'/>Untuk Kembali klik <a href=../../media.php?module=$module><em>disini</em></a></center>";
}

if ($module=='registrasi' AND $act=='addundangan'){
//if($_POST['pin'] and $_POST['i_thn_akademik'] and $_POST['c_gel'] and $_POST['n_lengkap'] and $_POST['n_jns_kelamin'] and $_POST['n_temp_lahir'] and $_POST['d_lahir'] and $_POST['n_alamat'] and $_POST['n_kabupaten'] and $_POST['n_propinsi'] and $_POST['c_pos'] and $_POST['i_telp'] and $_POST['i_hp'] and $_POST['n_email'] and $_POST['n_ortu'] and $_POST['n_jabatan'] and $_POST['n_sma'] and $_POST['i_jur_sma'] and $_POST['n_alamat_sma'] and $_POST['n_kab_sma']and $_POST['n_prop_sma'] and $_POST['n_pil1'] and $_POST['n_pil2'] and $_POST['n_pil3'] and $_POST['i_temp_ujian'] and $_POST['c_inf'] and $_POST['q_sdp2'] and $_POST['c_jalur'])
//{
$i_registrasi=$_POST['pin'];
$i_thn_akademik=$_POST['i_thn_akademik'];
$c_gel=$_POST['c_gel'];
$n_lengkap=$_POST['n_lengkap'];
$n_jns_kelamin=$_POST['n_jns_kelamin'];
$n_temp_lahir=$_POST['n_temp_lahir'];
$d_lahir=$_POST['d_lahir'];
$n_alamat=$_POST['n_alamat'];
$n_kabupaten=$_POST['n_kabupaten'];
$n_propinsi=$_POST['n_propinsi'];
//$n_kota_lain=$_POST['n_kota_lain'];
$c_pos=$_POST['c_pos'];
$i_telp=$_POST['i_telp'];
$i_hp=$_POST['i_hp'];
$n_email=$_POST['n_email'];
$n_ortu=$_POST['n_ortu'];
$n_ibu=$_POST['n_ibu'];
//$n_instansi=$_POST['n_instansi'];
$n_jabatan=$_POST['n_jabatan'];
$nis=$_POST['nis'];
$n_sma=$_POST['n_sma'];
$i_jur_sma=$_POST['i_jur_sma'];
$n_alamat_sma=$_POST['n_alamat_sma'];
$n_kab_sma=$_POST['n_kab_sma'];
$n_prop_sma=$_POST['n_prop_sma'];
$n_pil1=$_POST['n_pil1'];
$n_pil2=$_POST['n_pil2'];
$n_pil3=$_POST['n_pil3'];
$i_temp_ujian=$_POST['i_temp_ujian'];
$c_inf=$_POST['c_inf'];
//$q_sdp2=$_POST['q_sdp2'];
//$e_prestasi=$_POST['e_prestasi'];
$c_jalur=$_POST['c_jalur'];
//$i_foto = $_POST['photo'];
$i_agama = $_POST['i_agama'];

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
$image=$_FILES['photo']['name'];
if ($image) 
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
 
		$image_name=$_POST['pin'].'.'.$extension;
		$newname="../../foto/".$image_name;
 
		$copied = copy($_FILES['photo']['tmp_name'], $newname);
		
	}
 
}



$undangan=$_FILES['surat']['name'];
if ($undangan) 
{
	$filename = stripslashes($_FILES['surat']['name']);
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
		$size=filesize($_FILES['surat']['tmp_name']);
 
		if ($size > MAX_SIZE*10024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name2=$_POST['pin'].'.'.$extension;
		$undangan="../../surat/".$image_name2;
 
		$copied = copy($_FILES['surat']['tmp_name'], $smt11);
		
	}
 
}

replace_meta_chars(mysql_query("insert into t_calon_mahasiswa (i_registrasi,i_thn_akademik,c_gel,n_lengkap,n_jns_kelamin,n_temp_lahir,d_lahir,n_alamat,n_kabupaten,n_propinsi,
c_pos,i_telp,i_hp,n_email,n_ortu,n_ibu,n_jabatan,nis,n_sma,i_jur_sma,n_alamat_sma,n_kab_sma,n_prop_sma,n_pil1,n_pil2,
n_pil3,i_temp_ujian,c_inf,c_jalur,status,metode,n_agama,photo,smt11) values('$i_registrasi','$i_thn_akademik','$c_gel','$n_lengkap','$n_jns_kelamin','$n_temp_lahir','$d_lahir','$n_alamat','$n_kabupaten','$n_propinsi','$c_pos','$i_telp','$i_hp','$n_email','$n_ortu','$n_ibu','$n_jabatan','$nis','$n_sma','$i_jur_sma',
'$n_alamat_sma','$n_kab_sma','$n_prop_sma','$n_pil1','$n_pil2','$n_pil3','$i_temp_ujian','$c_inf','$c_jalur','Registrasi','online','$i_agama','$image_name','$image_name2')"));
replace_meta_chars(mysql_query("UPDATE t_pin SET `status` = 'aktif' WHERE t_pin.pin ='$i_registrasi' LIMIT 1 ;"));

replace_meta_chars(mysql_query("INSERT INTO t_kelulusan (i_registrasi,n_nama,kd_prodi) VALUES ('$i_registrasi','$n_lengkap','$n_pil1')"));

$sql_tampil="select t_calon_mahasiswa.*,t_gel.namagel as nama_gel,t_gel.jalur as jalur from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel  where t_calon_mahasiswa.i_registrasi='$i_registrasi'";
  $query_tampil=mysql_query($sql_tampil,$koneksi);
  $row_tampil=mysql_fetch_array($query_tampil);
	//D3
	//pil 1
	if ($row_tampil[n_pil1] =='01')
	{
		$pil1 = "D3 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil1] =='02')
	{
			$pil1 = "D3 - Manajemen Bisnis";
	}
	if ($row_tampil[n_pil1] =='03')
	{
		$pil1 = "D3 - Manajemen Informatika";
	}
	
	if($row_tampil[n_pil1] =='04')
	{
			$pil1 = "D3 - Teknik Informatika";
	}
	if($row_tampil[n_pil1] =='05')
	{
			$pil1 = "D3 - Akuntansi";
	}
	if($row_tampil[n_pil1] =='21')
	{
			$pil1 = "S1 - Manajemen Logistik";
	}
	if($row_tampil[n_pil1] =='22')
	{
			$pil1 = "S1 - Manajemen Transportasi";
	}
       
       if($row_tampil[n_pil1] =='31')
	{
			$pil1 = "D3 - Akselerasi Teknik Informatika";
	}
	if($row_tampil[n_pil1] =='32')
	{
			$pil1 = "D3 - Akselerasi Akuntansi";
	}
	
	if($row_tampil[n_pil1] =='34')
	{
			$pil1 = "D4 - CLC (Akselerasi Logistik Bisnis)";
	}
	if($row_tampil[n_pil1] =='35')
	{
			$pil1 = "D4 - CAC (Akselerasi Akuntansi)";
	}

	//---pil 2
	if ($row_tampil[n_pil2] =='01')
	{
		$pil2 = "D3 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil2] =='02')
	{
			$pil2 = "D3 - Manajemen Bisnis";
	}
	if ($row_tampil[n_pil2] =='03')
	{
		$pil2 = "D3 - Manajemen Informatika";
	}
	
	if($row_tampil[n_pil2] =='04')
	{
			$pil2 = "D3 - Teknik Informatika";
	}
	if($row_tampil[n_pil2] =='05')
	{
			$pil2 = "D3 - Akuntansi";
	}
	if($row_tampil[n_pil2] =='21')
	{
			$pil2 = "S1 - Manajemen Logistik";
	}
	if($row_tampil[n_pil2] =='22')
	{
			$pil2 = "S1 - Manajemen Transportasi";
	}

      if($row_tampil[n_pil2] =='31')
	{
			$pil2 = "D3 - Akselerasi Teknik Informatika";
	}
	if($row_tampil[n_pil2] =='32')
	{
			$pil2 = "D3 - Akselerasi Akuntansi";
	}
	
	if($row_tampil[n_pil2] =='34')
	{
			$pil2 = "D4 - CLC (Akselerasi Logistik Bisnis)";
	}
	if($row_tampil[n_pil2] =='35')
	{
			$pil2 = "D4 - CAC (Akselerasi Akuntansi)";
	}

	//-- pil 3
	if ($row_tampil[n_pil3] =='01')
	{
		$pil3 = "D3 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil3] =='02')
	{
			$pil3 = "D3 - Manajemen Bisnis";
	}
	if ($row_tampil[n_pil3] =='03')
	{
		$pil3 = "D3 - Manajemen Informatika";
	}
	
	if($row_tampil[n_pil3] =='04')
	{
			$pil3 = "D3 - Teknik Informatika";
	}
	if($row_tampil[n_pil3] =='05')
	{
			$pil3 = "D3 - Akuntansi";
	}
	if($row_tampil[n_pil3] =='21')
	{
			$pil3 = "S1 - Manajemen Logistik";
	}
	if($row_tampil[n_pil3] =='22')
	{
			$pil3 = "S1 - Manajemen Transportasi";
	}

	if($row_tampil[n_pil3] =='31')
	{
			$pil3 = "D3 - Akselerasi Teknik Informatika";
	}
	if($row_tampil[n_pil3] =='32')
	{
			$pil3 = "D3 - Akselerasi Akuntansi";
	}
	
	if($row_tampil[n_pil3] =='34')
	{
			$pil3 = "D4 - CLC (Akselerasi Logistik Bisnis)";
	}
	if($row_tampil[n_pil3] =='35')
	{
			$pil3 = "D4 - CAC (Akselerasi Akuntansi)";
	}

	//D4
	//pil 1
	if ($row_tampil[n_pil1] =='11')
	{
		$pil1 = "D4 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil1] =='12')
	{
			$pil1 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($row_tampil[n_pil1] =='13')
	{
		$pil1 = "D4 - Teknik Informatika";
	}
	
	if($row_tampil[n_pil1] =='14')
	{
			$pil1 = "D4 - Akuntansi Keuangan";
	}
	//---pil 2
	if ($row_tampil[n_pil2] =='11')
	{
		$pil2 = "D4 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil2] =='12')
	{
			$pil2 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($row_tampil[n_pil2] =='13')
	{
		$pil2 = "D4 - Teknik Informatika";
	}
	
	if($row_tampil[n_pil2] =='14')
	{
			$pil2 = "D4 - Akuntansi Keuangan";
	}
	//-- pil 3
	if ($row_tampil[n_pil3] =='11')
	{
		$pil3 = "D4 - Logistik Bisnis";
	}
	
	if($row_tampil[n_pil3] =='12')
	{
			$pil3 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($row_tampil[n_pil3] =='13')
	{
		$pil3 = "D4 - Teknik Informatika";
	}
	
	if($row_tampil[n_pil3] =='14')
	{
			$pil3 = "D4 - Akuntansi Keuangan";
	}



	echo "<table width='100%' border='0'>
  <tr>
   &nbsp
  </tr>
  <tr>
    <center><h1>BUKTI PENDAFTARAN ONLINE MAHASISWA BARU <br>
POLTEKPOS & STIMLOG
<h1></center>
  </tr>
  <tr>
   &nbsp
  </tr>
  <tr>
    <td colspan='3'><B>DATA PENDAFTAR</B></td>
  </tr>
  <tr>
    <td width='5%'>No Pendaftaran </td>
    <td width='1%'>:</td>
    <td>$row_tampil[0]</td>
  </tr>
  <tr>
    <td width='20%'>Nama Peserta </td>
    <td width='1%'>:</td>
    <td width='92%'>$row_tampil[3]</td>
  </tr>
  <tr>
    <td width='20%'>NISN</td>
    <td width='1%'>:</td>
    <td width='92%'>$row_tampil[nis]</td>
  </tr>
  <tr>
    <td width='20%'>Email</td>
    <td width='1%'>:</td>
    <td width='92%'>$row_tampil[n_email]</td>
  </tr>
  <tr>
    <td>Jalur</td>
    <td>:</td>
    <td>$row_tampil[jalur] - $row_tampil[nama_gel]</td>
  </tr>
  <tr>
    <td colspan='3'><B>PILIHAN PROGRAM STUDI</B></td>
  </tr>
  <tr>
    <td>Pilihan 1 </td>
    <td>:</td>
    <td>$pil1</td>
  </tr>
  <tr>
    <td>Pilihan 2 </td>
    <td>:</td>
    <td>$pil2</td>
  </tr>
  <tr>
    <td>Pilihan 3 </td>
    <td>:</td>
    <td>$pil3</td>
  </tr>
  <tr>
    <td colspan='3'><b>INFO LEBIH LANJUT HUBUNGI</b> : 
<ul>
<li>
Sekretariat PMB Poltekpos-Stimlog<br />
Jl. Sariasih No.54 Bandung 40151<br />
Tlp: 022-2009562, 022-61693672, 022-93250092, Fax : 022-2011089<br />
E-mail : info@poltekpos.ac.id,pmb@poltekpos.ac.id<br />
http//: pmb.poltekpos.ac.id</li>
</ul>			
</td>
  </tr>
</table>
";

//}
  //header('location:../../media.php?module='.$module);
  echo "<center><input TYPE='button' onClick='window.print()' value='Cetak Bukti Pendaftaran'> Untuk Kembali klik <a href=../../media.php?module=$module><em>disini</em></a></center>";

}

}
?>
