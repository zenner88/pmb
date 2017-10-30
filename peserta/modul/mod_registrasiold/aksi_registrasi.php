<?php
session_start();
 if (empty($_SESSION['pin']) AND empty($_SESSION['kodeaktivasi'])){
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
if ($module=='registrasi' AND $act=='addreguler'){
if($_POST['pin'] and $_POST['i_thn_akademik'] and $_POST['c_gel'] and $_POST['n_lengkap'] and $_POST['n_jns_kelamin'] and $_POST['n_temp_lahir'] and $_POST['d_lahir'] and $_POST['n_alamat'] and $_POST['n_kabupaten'] and $_POST['n_propinsi'] and $_POST['c_pos'] and $_POST['i_telp'] and $_POST['i_hp'] and $_POST['n_email'] and $_POST['n_ortu'] and $_POST['n_jabatan'] and $_POST['n_sma'] and $_POST['i_jur_sma'] and $_POST['n_alamat_sma'] and $_POST['n_kab_sma']and $_POST['n_prop_sma'] and $_POST['n_pil1'] and $_POST['n_pil2'] and $_POST['n_pil3'] and $_POST['i_temp_ujian'] and $_POST['c_inf'] and $_POST['q_sdp2'] and $_POST['c_jalur'])
{
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
$n_instansi=$_POST['n_instansi'];
$n_jabatan=$_POST['n_jabatan'];
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
$q_sdp2=$_POST['q_sdp2'];
$e_prestasi=$_POST['e_prestasi'];
$c_jalur=$_POST['c_jalur'];
$i_foto = $_POST['photo'];
replace_meta_chars(mysql_query("insert into t_calon_mahasiswa (i_registrasi,i_thn_akademik,c_gel,n_lengkap,n_jns_kelamin,n_temp_lahir,d_lahir,n_alamat,n_kabupaten,n_propinsi,
n_kota_lain,c_pos,i_telp,i_hp,n_email,n_ortu,n_instansi,n_jabatan,n_sma,i_jur_sma,n_alamat_sma,n_kab_sma,n_prop_sma,n_pil1,n_pil2,
n_pil3,i_temp_ujian,c_inf,q_sdp2,e_prestasi,c_jalur,status) values('$i_registrasi','$i_thn_akademik','$c_gel','$n_lengkap','$n_jns_kelamin','$n_temp_lahir','$d_lahir','$n_alamat','$n_kabupaten','$n_propinsi','$n_kota_lain','$c_pos','$i_telp','$i_hp','$n_email','$n_ortu','$n_instansi','$n_jabatan','$n_sma','$i_jur_sma',
'$n_alamat_sma','$n_kab_sma','$n_prop_sma','$n_pil1','$n_pil2','$n_pil3','$i_temp_ujian','$c_inf','$q_sdp2','$e_prestasi','$c_jalur','Registrasi')"));

$sql_tampil="select t_calon_mahasiswa.*,t_gel.namagel as nama_gel,t_tempat_ujian.namatmp as temp_ujian from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel inner join t_tempat_ujian on t_calon_mahasiswa.i_temp_ujian=t_tempat_ujian.kodetmp where t_calon_mahasiswa.i_registrasi='$i_registrasi'";
  $query_tampil=mysql_query($sql_tampil,$koneksi);
  $row_tampil=mysql_fetch_array($query_tampil);
  	echo "Terimakasih anda telah melakukan pendaftaran di POLITEKNIK POS INDONESIA";
	echo "<br>";
	echo "Simpan baik-baik kode registrasi anda, jangan sampai hilang";
	echo "<br>";
	echo "<font size='2' color='#006699'>Nama Peserta : $row_tampil[3]</font>";
	echo"<br>";
	echo "<font size='2' color='#006699'>Nomor Registrasi : <font size='3'>$row_tampil[0]</font></font>";
	echo"<br>";
	echo "<font size='2' color='#006699'>Gelombang : $row_tampil[nama_gel]</font>";
	echo"<br>";
	echo "<font size='2' color='#006699'>Tanggal Lahir : $row_tampil[6]</font>";
	echo"<br>";

	if ($row_tampil[23] =='MI')
	{
		$pil1 = "Manajemen Informatika";
	}

	if($row_tampil[23] =='TI')
	{
			$pil1 = "Teknik Informatika";
	}

	if($row_tampil[23] =='AK')
	{
			$pil1 = "Akuntansi";
	}

	if($row_tampil[23] =='PM')
	{
			$pil1 = "Pemasaran";
	}

	if($row_tampil[23] =='LB')
	{
			$pil1 = "Logistik Bisnis";
	}

	if($row_tampil[23] =='MF')
	{
			$pil1 = "Micro Finance";
	}

	if ($row_tampil[23] == 'LB4')
	{
		$pil1 = "Logistik Bisnis D4";
	}
	if ($row_tampil[23] == 'TI4')
	{
		$pil1 = "Teknik Informatika D4";
	}
	if ($row_tampil[23] == 'MI4')
	{
		$pil1 = "Manajemen Informatika D4";
	}
	if ($row_tampil[23] == 'AK4')
	{
		$pil1 = "Akuntansi D4";
	}
	if ($row_tampil[23] == 'PM4')
	{
		$pil1 = "Pemasaran D4";
	}
	if ($row_tampil[23] == 'LB4A')
	{
		$pil1 = "Ekstensi Logistik Bisnis D4";
	}
	if ($row_tampil[23] == 'TI4A')
	{
		$pil1 = "Ekstensi Teknik Informatika D4";
	}
	if ($row_tampil[23] == 'MI4A')
	{
		$pil1 = "Ekstensi Manajemen Informatika D4";
	}
	if ($row_tampil[23] == 'AK4A')
	{
		$pil1 = "Ekstensi Akuntansi D4";
	}
	if ($row_tampil[23] == 'PM4A')
	{
		$pil1 = "Ekstensi Pemasaran D4";
	}



	if ($row_tampil[24] =='MI')
	{
		$pil2 = "Manajemen Informatika";
	}

	if($row_tampil[24] =='TI')
	{
			$pil2 = "Teknik Informatika";
	}

	if($row_tampil[24] =='AK')
	{
			$pil2 = "Akuntansi";
	}

	if($row_tampil[24] =='PM')
	{
			$pil2 = "Pemasaran";
	}

	if($row_tampil[24] =='LB')
	{
			$pil2 = "Logistik Bisnis";
	}

	if($row_tampil[24] =='MF')
	{
			$pil2 = "Micro Finance";
	}

	if ($row_tampil[24] == 'LB4')
	{
		$pil2 = "Logistik Bisnis D4";
	}
	if ($row_tampil[24] == 'TI4')
	{
		$pil2 = "Teknik Informatika D4";
	}
	if ($row_tampil[24] == 'MI4')
	{
		$pil2 = "Manajemen Informatika D4";
	}
	if ($row_tampil[24] == 'AK4')
	{
		$pil2 = "Akuntansi D4";
	}
	if ($row_tampil[24] == 'PM4')
	{
		$pil2 = "Pemasaran D4";
	}
	if ($row_tampil[24] == 'LB4A')
	{
		$pil2 = "Ekstensi Logistik Bisnis D4";
	}
	if ($row_tampil[24] == 'TI4A')
	{
		$pil2 = "Ekstensi Teknik Informatika D4";
	}
	if ($row_tampil[24] == 'MI4A')
	{
		$pil2 = "Ekstensi Manajemen Informatika D4";
	}
	if ($row_tampil[24] == 'AK4A')
	{
		$pil2 = "Ekstensi Akuntansi D4";
	}
	if ($row_tampil[24] == 'PM4A')
	{
		$pil2 = "Ekstensi Pemasaran D4";
	}



	if ($row_tampil[25] =='MI')
	{
		$pil3 = "Manajemen Informatika";
	}

	if($row_tampil[25] =='TI')
	{
			$pil3 = "Teknik Informatika";
	}

	if($row_tampil[25] =='AK')
	{
			$pil3 = "Akuntansi";
	}

	if($row_tampil[25] =='PM')
	{
			$pil3 = "Pemasaran";
	}

	if($row_tampil[25] =='LB')
	{
			$pil3 = "Logistik Bisnis";
	}

	if($row_tampil[25] =='MF')
	{
			$pil3 = "Micro Finance";
	}

	if ($row_tampil[25] == 'LB4')
	{
		$pil3 = "Logistik Bisnis D4";
	}
	if ($row_tampil[25] == 'TI4')
	{
		$pil3 = "Teknik Informatika D4";
	}
	if ($row_tampil[25] == 'MI4')
	{
		$pil3 = "Manajemen Informatika D4";
	}
	if ($row_tampil[25] == 'AK4')
	{
		$pil3 = "Akuntansi D4";
	}
	if ($row_tampil[25] == 'PM4')
	{
		$pil3 = "Pemasaran D4";
	}
	if ($row_tampil[25] == 'LB4A')
	{
		$pil3 = "Ekstensi Logistik Bisnis D4";
	}
	if ($row_tampil[25] == 'TI4A')
	{
		$pil3 = "Ekstensi Teknik Informatika D4";
	}
	if ($row_tampil[25] == 'MI4A')
	{
		$pil3 = "Ekstensi Manajemen Informatika D4";
	}
	if ($row_tampil[25] == 'AK4A')
	{
		$pil3 = "Ekstensi Akuntansi D4";
	}
	if ($row_tampil[25] == 'PM4A')
	{
		$pil3 = "Ekstensi Pemasaran D4";
	}



	echo "<font size='2' color='#006699'>Pilahan Program Studi 1 : $pil1</font>";
	echo"<br>";
	echo "<font size='2' color='#006699'>Pilahan Program Studi 2 : $pil2</font>";
	echo"<br>";
	echo "<font size='2' color='#006699'>Pilahan Program Studi 3 : $pil3</font>";
	echo"<br>";
	echo "<font size='2' color='#006699'>Tempat Ujian : $row_tampil[temp_ujian]</font>";
}
  //header('location:../../media.php?module='.$module);  e
  echo "<center>Untuk Kembali klik <a href=../../media.php?module=$module><em>disini</em></a></center>";
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
$n_instansi=$_POST['n_instansi'];
$n_jabatan=$_POST['n_jabatan'];
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
replace_meta_chars(mysql_query("insert into t_calon_mahasiswa (i_registrasi,i_thn_akademik,c_gel,n_lengkap,n_jns_kelamin,n_temp_lahir,d_lahir,n_alamat,n_kabupaten,n_propinsi,n_kota_lain,c_pos,i_telp,
i_hp,n_email,n_ortu,n_instansi,n_jabatan,n_sma,i_jur_sma,n_alamat_sma,n_kab_sma,n_prop_sma,n_pil1,n_pil2,
n_pil3,i_temp_ujian,c_inf,q_sdp2,e_prestasi,rata2_XI_2,mtk_XI_2,ing_XI_2,rata2_XII_1,mtk_XII_1,ing_XII_1,c_jalur,status) values('$i_registrasi','$i_thn_akademik','$c_gel','$n_lengkap','$n_jns_kelamin','$n_temp_lahir','$d_lahir','$n_alamat','$n_kabupaten','$n_propinsi','-','$c_pos','$i_telp','$i_hp','$n_email','$n_ortu','$n_instansi','$n_jabatan','$n_sma','$i_jur_sma',
'$n_alamat_sma','$n_kab_sma','$n_prop_sma','$n_pil1','$n_pil2','$n_pil3','-','-','$q_sdp2','$e_prestasi','$rata2_XI_2','$mtk_XI_2','$ing_XI_2','$rata2_XII_1','$mtk_XII_1','$ing_XII_1','$c_jalur','Registrasi')"));


$sql_tampil="select t_calon_mahasiswa.*,t_gel.namagel as nama_gel from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel where t_calon_mahasiswa.i_registrasi='$i_registrasi'";
  $query_tampil=mysql_query($sql_tampil,$koneksi);
  $row_tampil=mysql_fetch_array($query_tampil);
  	echo "Terimakasih anda telah melakukan pendaftaran di POLITEKNIK POS INDONESIA";
	echo "<br>";
	echo "Simpan baik-baik kode registrasi anda, jangan sampai hilang";
	echo "<br>";
	echo "<font size='2' color='#006699'>Nama Peserta : $row_tampil[3]</font>";
	echo"<br>";
	echo "<font size='2' color='#006699'>Nomor Registrasi : <font size='3'>$row_tampil[0]</font></font>";
	echo"<br>";
	echo "<font size='2' color='#006699'>Gelombang : $row_tampil[nama_gel]</font>";
	echo"<br>";
	echo "<font size='2' color='#006699'>Tanggal Lahir : $row_tampil[6]</font>";
	echo"<br>";

	if ($row_tampil[23] =='MI')
	{
		$pil1 = "Manajemen Informatika";
	}

	if($row_tampil[23] =='TI')
	{
			$pil1 = "Teknik Informatika";
	}

	if($row_tampil[23] =='AK')
	{
			$pil1 = "Akuntansi";
	}

	if($row_tampil[23] =='PM')
	{
			$pil1 = "Pemasaran";
	}

	if($row_tampil[23] =='LB')
	{
			$pil1 = "Logistik Bisnis";
	}

	if($row_tampil[23] =='MF')
	{
			$pil1 = "Micro Finance";
	}

	if ($row_tampil[23] == 'LB4')
	{
		$pil1 = "Logistik Bisnis D4";
	}
	if ($row_tampil[23] == 'TI4')
	{
		$pil1 = "Teknik Informatika D4";
	}
	if ($row_tampil[23] == 'MI4')
	{
		$pil1 = "Manajemen Informatika D4";
	}
	if ($row_tampil[23] == 'AK4')
	{
		$pil1 = "Akuntansi D4";
	}
	if ($row_tampil[23] == 'PM4')
	{
		$pil1 = "Pemasaran D4";
	}
	if ($row_tampil[23] == 'LB4A')
	{
		$pil1 = "Ekstensi Logistik Bisnis D4";
	}
	if ($row_tampil[23] == 'TI4A')
	{
		$pil1 = "Ekstensi Teknik Informatika D4";
	}
	if ($row_tampil[23] == 'MI4A')
	{
		$pil1 = "Ekstensi Manajemen Informatika D4";
	}
	if ($row_tampil[23] == 'AK4A')
	{
		$pil1 = "Ekstensi Akuntansi D4";
	}
	if ($row_tampil[23] == 'PM4A')
	{
		$pil1 = "Ekstensi Pemasaran D4";
	}



	if ($row_tampil[24] =='MI')
	{
		$pil2 = "Manajemen Informatika";
	}

	if($row_tampil[24] =='TI')
	{
			$pil2 = "Teknik Informatika";
	}

	if($row_tampil[24] =='AK')
	{
			$pil2 = "Akuntansi";
	}

	if($row_tampil[24] =='PM')
	{
			$pil2 = "Pemasaran";
	}

	if($row_tampil[24] =='LB')
	{
			$pil2 = "Logistik Bisnis";
	}

	if($row_tampil[24] =='MF')
	{
			$pil2 = "Micro Finance";
	}

	if ($row_tampil[24] == 'LB4')
	{
		$pil2 = "Logistik Bisnis D4";
	}
	if ($row_tampil[24] == 'TI4')
	{
		$pil2 = "Teknik Informatika D4";
	}
	if ($row_tampil[24] == 'MI4')
	{
		$pil2 = "Manajemen Informatika D4";
	}
	if ($row_tampil[24] == 'AK4')
	{
		$pil2 = "Akuntansi D4";
	}
	if ($row_tampil[24] == 'PM4')
	{
		$pil2 = "Pemasaran D4";
	}
	if ($row_tampil[24] == 'LB4A')
	{
		$pil2 = "Ekstensi Logistik Bisnis D4";
	}
	if ($row_tampil[24] == 'TI4A')
	{
		$pil2 = "Ekstensi Teknik Informatika D4";
	}
	if ($row_tampil[24] == 'MI4A')
	{
		$pil2 = "Ekstensi Manajemen Informatika D4";
	}
	if ($row_tampil[24] == 'AK4A')
	{
		$pil2 = "Ekstensi Akuntansi D4";
	}
	if ($row_tampil[24] == 'PM4A')
	{
		$pil2 = "Ekstensi Pemasaran D4";
	}



	if ($row_tampil[25] =='MI')
	{
		$pil3 = "Manajemen Informatika";
	}

	if($row_tampil[25] =='TI')
	{
			$pil3 = "Teknik Informatika";
	}

	if($row_tampil[25] =='AK')
	{
			$pil3 = "Akuntansi";
	}

	if($row_tampil[25] =='PM')
	{
			$pil3 = "Pemasaran";
	}

	if($row_tampil[25] =='LB')
	{
			$pil3 = "Logistik Bisnis";
	}

	if($row_tampil[25] =='MF')
	{
			$pil3 = "Micro Finance";
	}

	if ($row_tampil[25] == 'LB4')
	{
		$pil3 = "Logistik Bisnis D4";
	}
	if ($row_tampil[25] == 'TI4')
	{
		$pil3 = "Teknik Informatika D4";
	}
	if ($row_tampil[25] == 'MI4')
	{
		$pil3 = "Manajemen Informatika D4";
	}
	if ($row_tampil[25] == 'AK4')
	{
		$pil3 = "Akuntansi D4";
	}
	if ($row_tampil[25] == 'PM4')
	{
		$pil3 = "Pemasaran D4";
	}
	if ($row_tampil[25] == 'LB4A')
	{
		$pil3 = "Ekstensi Logistik Bisnis D4";
	}
	if ($row_tampil[25] == 'TI4A')
	{
		$pil3 = "Ekstensi Teknik Informatika D4";
	}
	if ($row_tampil[25] == 'MI4A')
	{
		$pil3 = "Ekstensi Manajemen Informatika D4";
	}
	if ($row_tampil[25] == 'AK4A')
	{
		$pil3 = "Ekstensi Akuntansi D4";
	}
	if ($row_tampil[25] == 'PM4A')
	{
		$pil3 = "Ekstensi Pemasaran D4";
	}



	echo "<font size='2' color='#006699'>Pilahan Program Studi 1 : $pil1</font>";
	echo"<br>";
	echo "<font size='2' color='#006699'>Pilahan Program Studi 2 : $pil2</font>";
	echo"<br>";
	echo "<font size='2' color='#006699'>Pilahan Program Studi 3 : $pil3</font>";
	echo"<br>";
	echo "<font size='2' color='#006699'>Tempat Ujian : $row_tampil[temp_ujian]</font>";
		echo"<br>";
	echo "<font size='2' color='red'>Lampirkan Fotocopy Raport dan Surat Keterangan dari Kepala Sekolah</font>";
        echo"<br>";
	echo "<font size='2' color='red'>Kirim Ke Politeknik Pos Indonesia</font>";
	echo"<br>";
	echo "<font size='2' color='red'>Jl. Sariasih No. 54 Bandung 40151</font>";
	echo"<br>";
	echo "<font size='2' color='red'>Telp. 022-2009562-2009570 Fax. 022-2009568</font>";
//}
  //header('location:../../media.php?module='.$module);
  echo "<center>Untuk Kembali klik <a href=../../media.php?module=$module><em>disini</em></a></center>";
}
}
?>
