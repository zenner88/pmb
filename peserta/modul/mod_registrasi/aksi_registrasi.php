<?php
error_reporting(0);
session_start();
 if (empty($_SESSION['kode_briva']) AND empty($_SESSION['password']) AND empty($_SESSION['jalur_pendaftaran'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else {

 include "../../../config/koneksi.php";
 include "../../config/antisqlinjection.php";
 
 	$module=$_GET[module];
	$act=$_GET[act];
	if ($module=='registrasi' AND $act=='addreguler'){ 
		/*$sqlCek = mysql_query("select t_calon_mahasiswa.*,t_gel.namagel as nama_gel,t_tempat_ujian.namatmp as temp_ujian from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel inner join t_tempat_ujian on t_calon_mahasiswa.i_temp_ujian=t_tempat_ujian.kodetmp where t_calon_mahasiswa.i_registrasi='$_SESSION[kode_briva]'");
    if(mysql_num_rows($sqlCek)==0) { 

    } else {

    }*/
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

		$c_pos=$_POST['c_pos'];
		$i_telp=$_POST['i_telp'];
		$i_hp=$_POST['i_hp'];
		$n_email=$_POST['n_email'];
		$n_ortu=$_POST['n_ortu'];
		$n_ibu=$_POST['n_ibu'];
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
		$i_temp_ujian= $_POST['i_temp_ujian'];
		$c_inf=$_POST['c_inf'];
		$c_jalur=$_POST['c_jalur'];
		$i_agama = $_POST['n_agama'];
		$nama_guru_bk = $_POST['n_guru_bk'];
		$no_guru_bk = $_POST['n_hp_guru_bk'];
		
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
		if ($_SESSION['jalur_pendaftaran'] == "Reguler") {
			$image=$_FILES['photo']['name'];
			if ($image) {
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
			 
					$image_name= $_POST['nis'].'.'.$extension;
					$newname="../../pi/jalur_pendaftaran/reguler/photo_pendaftar/".$image_name;
			 
					$copied = copy($_FILES['photo']['tmp_name'], $newname);
					
				}
			}
			mysql_query("UPDATE t_calon_mahasiswa SET i_thn_akademik = '$i_thn_akademik', c_gel = '$c_gel', n_lengkap = '$n_lengkap', n_jns_kelamin = '$n_jns_kelamin', n_temp_lahir = '$n_temp_lahir', d_lahir = '$d_lahir', n_alamat = '$n_alamat', n_kabupaten = '$n_kabupaten', n_propinsi = '$n_propinsi', c_pos = '$c_pos', i_telp = '$i_telp', i_hp = '$i_hp', n_email = '$n_email', n_ortu = '$n_ortu', n_ibu = '$n_ibu', n_jabatan = '$n_jabatan', nis = '$nis', n_sma = '$n_sma', i_jur_sma = '$i_jur_sma', n_alamat_sma = '$n_alamat_sma', n_kab_sma = '$n_kab_sma', n_prop_sma = '$n_prop_sma', n_pil1 = '$n_pil1', n_pil2 = '$n_pil2', n_pil3 = '$n_pil3', i_temp_ujian = '$i_temp_ujian', c_inf = '$c_inf', c_jalur = '$c_jalur', n_agama = '$i_agama', photo = '$image_name', nama_guru_bk = '$nama_guru_bk', no_guru_bk = '$no_guru_bk' WHERE i_registrasi = '$i_registrasi'");
			$sqlCek = mysql_query("select t_calon_mahasiswa.*,t_gel.namagel as nama_gel,t_tempat_ujian.namatmp as temp_ujian from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel inner join t_tempat_ujian on t_calon_mahasiswa.i_temp_ujian=t_tempat_ujian.kodetmp where t_calon_mahasiswa.i_registrasi='$i_registrasi'");
    		if(mysql_num_rows($sqlCek)==0) { 
    			header('Location: ../../media.php?module=registrasi');
    			die;
    		} else {
    			header('Location: ../../media.php?module=registrasi');
    		}
		}
		
		if ($_SESSION['jalur_pendaftaran'] == "Undangan") {
			$image=$_FILES['photo']['name'];
			if ($image) {
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
			 
					$image_name= $_POST['nis'].'.'.$extension;
					$newname="../../pi/jalur_pendaftaran/undangan/photo_pendaftar/".$image_name;
			 
					$copied = copy($_FILES['photo']['tmp_name'], $newname);
					
				}
			}
			$undangan=$_FILES['surat']['name'];
			if ($undangan) {
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
			 
					$image_name2=$_POST['nis'].'.'.$extension;
					$undangan="../../pi/jalur_pendaftaran/undangan/surat_undangan/".$image_name2;
			 
					$copied = copy($_FILES['surat']['tmp_name'], $undangan);
					
				}
			}
			mysql_query("UPDATE t_calon_mahasiswa SET i_thn_akademik = '$i_thn_akademik', c_gel = '$c_gel', n_lengkap = '$n_lengkap', n_jns_kelamin = '$n_jns_kelamin', n_temp_lahir = '$n_temp_lahir', d_lahir = '$d_lahir', n_alamat = '$n_alamat', n_kabupaten = '$n_kabupaten', n_propinsi = '$n_propinsi', c_pos = '$c_pos', i_telp = '$i_telp', i_hp = '$i_hp', n_email = '$n_email', n_ortu = '$n_ortu', n_ibu = '$n_ibu', n_jabatan = '$n_jabatan', nis = '$nis', n_sma = '$n_sma', i_jur_sma = '$i_jur_sma', n_alamat_sma = '$n_alamat_sma', n_kab_sma = '$n_kab_sma', n_prop_sma = '$n_prop_sma', n_pil1 = '$n_pil1', n_pil2 = '$n_pil2', n_pil3 = '$n_pil3', i_temp_ujian = '$i_temp_ujian', c_inf = '$c_inf', c_jalur = '$c_jalur', n_agama = '$i_agama', photo = '$image_name', surat = '$image_name2', nama_guru_bk = '$nama_guru_bk', no_guru_bk = '$no_guru_bk' WHERE i_registrasi = '$i_registrasi'");
			$sqlCek = mysql_query("select t_calon_mahasiswa.*,t_gel.namagel as nama_gel,t_tempat_ujian.namatmp as temp_ujian from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel inner join t_tempat_ujian on t_calon_mahasiswa.i_temp_ujian=t_tempat_ujian.kodetmp where t_calon_mahasiswa.i_registrasi='$i_registrasi'");
    		if(mysql_num_rows($sqlCek)==0) { 
    			header('Location: ../../media.php?module=registrasi');
    			die;
    		} else {
    			header('Location: ../../media.php?module=registrasi');
    		}
		}
		if ($_SESSION['jalur_pendaftaran'] == "Jalur Prestasi/ PMDK") {
			$c_nilai_mtk_3 = $_POST['c_nilai_mtk_3'];
			$c_nilai_mtk_4 = $_POST['c_nilai_mtk_4'];
			$c_nilai_inggris_3 = $_POST['c_nilai_inggris_3'];
			$c_nilai_inggris_4 = $_POST['c_nilai_inggris_4'];
			$image=$_FILES['photo']['name'];
			if ($image) {
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
			 
					$image_name= $_POST['nis'].'.'.$extension;
					$newname="../../pi/jalur_pendaftaran/pmdk/photo_pendaftar/".$image_name;
			 
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
			 
					$image_name2=$_POST['nis'].'.'.$extension;
					$smt11="../../pi/jalur_pendaftaran/pmdk/raport_semester_3/".$image_name2;
			 
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
			 
					$image_name3=$_POST['nis'].'.'.$extension;
					$smt12="../../pi/jalur_pendaftaran/pmdk/raport_semester_4/".$image_name3;
			 
					$copied = copy($_FILES['smt12']['tmp_name'], $smt12);
					
				}
			 
			}
			$surat_rekomendasi=$_FILES['surat_rekomendasi']['name'];
			if ($surat_rekomendasi) 
			{
				$filename = stripslashes($_FILES['surat_rekomendasi']['name']);
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
					$size=filesize($_FILES['surat_rekomendasi']['tmp_name']);
			 
					if ($size > MAX_SIZE*20024)
					{
						echo '<h4>You have exceeded the size limit!</h4>';
						$errors=1;
					}
			 
					$image_name4=$_POST['nis'].'.'.$extension;
					$surat_rekomendasi="../../pi/jalur_pendaftaran/pmdk/surat_rekomendasi/".$image_name4;
			 
					$copied = copy($_FILES['surat_rekomendasi']['tmp_name'], $surat_rekomendasi);
					
				}
			 
			}
			$surat_sertifikasi=$_FILES['surat_sertifikasi']['name'];
			if ($surat_sertifikasi) 
			{
				$filename = stripslashes($_FILES['surat_sertifikasi']['name']);
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
					$size=filesize($_FILES['surat_sertifikasi']['tmp_name']);
			 
					if ($size > MAX_SIZE*20024)
					{
						echo '<h4>You have exceeded the size limit!</h4>';
						$errors=1;
					}
			 
					$image_name5=$_POST['nis'].'.'.$extension;
					$surat_sertifikasi="../../pi/jalur_pendaftaran/pmdk/sertifikat/".$image_name5;
			 
					$copied = copy($_FILES['surat_sertifikasi']['tmp_name'], $surat_sertifikasi);
					
				}
			 
			}
			mysql_query("UPDATE t_calon_mahasiswa SET i_thn_akademik = '$i_thn_akademik', c_gel = '$c_gel', n_lengkap = '$n_lengkap', n_jns_kelamin = '$n_jns_kelamin', n_temp_lahir = '$n_temp_lahir', d_lahir = '$d_lahir', n_alamat = '$n_alamat', n_kabupaten = '$n_kabupaten', n_propinsi = '$n_propinsi', c_pos = '$c_pos', i_telp = '$i_telp', i_hp = '$i_hp', n_email = '$n_email', n_ortu = '$n_ortu', n_ibu = '$n_ibu', n_jabatan = '$n_jabatan', nis = '$nis', n_sma = '$n_sma', i_jur_sma = '$i_jur_sma', n_alamat_sma = '$n_alamat_sma', n_kab_sma = '$n_kab_sma', n_prop_sma = '$n_prop_sma', n_pil1 = '$n_pil1', n_pil2 = '$n_pil2', n_pil3 = '$n_pil3', i_temp_ujian = '$i_temp_ujian', c_inf = '$c_inf', c_jalur = '$c_jalur', n_agama = '$i_agama', photo = '$image_name', smt1 = '$image_name2', smt2 = '$image_name3', mtk_1 = '$c_nilai_mtk_3', mtk_2 = '$c_nilai_mtk_4', bing_1 = '$c_nilai_inggris_3', bing_2 = '$c_nilai_inggris_4', surat = '$image_name4', 'sertifikat' = '$image_name5', nama_guru_bk = '$nama_guru_bk', no_guru_bk = '$no_guru_bk' WHERE i_registrasi = '$i_registrasi'");
			$sqlCek = mysql_query("select t_calon_mahasiswa.*,t_gel.namagel as nama_gel,t_tempat_ujian.namatmp as temp_ujian from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel inner join t_tempat_ujian on t_calon_mahasiswa.i_temp_ujian=t_tempat_ujian.kodetmp where t_calon_mahasiswa.i_registrasi='$i_registrasi'");
    		if(mysql_num_rows($sqlCek)==0) { 
    			header('Location: ../../media.php?module=registrasi');
    			die;
    		} else {
    			header('Location: ../../media.php?module=registrasi');
    		}
		}
		if ($_SESSION['jalur_pendaftaran'] == "Jalur Mandiri") {
			$image=$_FILES['photo']['name'];
			if ($image) {
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
			 
					$image_name= $_POST['nis'].'.'.$extension;
					$newname="../../pi/jalur_pendaftaran/mandiri/photo_pendaftar/".$image_name;
			 
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
			 
					$image_name2=$_POST['nis'].'.'.$extension;
					$smt11="../../pi/jalur_pendaftaran/mandiri/raport_semester_1/".$image_name2;
			 
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
			 
					$image_name3=$_POST['nis'].'.'.$extension;
					$smt12="../../pi/jalur_pendaftaran/mandiri/raport_semester_2/".$image_name3;
			 
					$copied = copy($_FILES['smt12']['tmp_name'], $smt12);
					
				}
			 
			}
			$smt13=$_FILES['smt13']['name'];
			if ($smt13) 
			{
				$filename = stripslashes($_FILES['smt13']['name']);
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
					$size=filesize($_FILES['smt13']['tmp_name']);
			 
					if ($size > MAX_SIZE*20024)
					{
						echo '<h4>You have exceeded the size limit!</h4>';
						$errors=1;
					}
			 
					$image_name4=$_POST['nis'].'.'.$extension;
					$smt13="../../pi/jalur_pendaftaran/mandiri/raport_semester_3/".$image_name4;
			 
					$copied = copy($_FILES['smt13']['tmp_name'], $smt13);
					
				}
			 
			}
			$smt14=$_FILES['smt14']['name'];
			if ($smt14) 
			{
				$filename = stripslashes($_FILES['smt14']['name']);
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
					$size=filesize($_FILES['smt14']['tmp_name']);
			 
					if ($size > MAX_SIZE*20024)
					{
						echo '<h4>You have exceeded the size limit!</h4>';
						$errors=1;
					}
			 
					$image_name5=$_POST['nis'].'.'.$extension;
					$smt14="../../pi/jalur_pendaftaran/mandiri/raport_semester_4/".$image_name5;
			 
					$copied = copy($_FILES['smt14']['tmp_name'], $smt14);
					
				}
			 
			}
			$smt15=$_FILES['smt15']['name'];
			if ($smt15) 
			{
				$filename = stripslashes($_FILES['smt15']['name']);
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
					$size=filesize($_FILES['smt15']['tmp_name']);
			 
					if ($size > MAX_SIZE*20024)
					{
						echo '<h4>You have exceeded the size limit!</h4>';
						$errors=1;
					}
			 
					$image_name6=$_POST['nis'].'.'.$extension;
					$smt15="../../pi/jalur_pendaftaran/mandiri/raport_semester_5/".$image_name6;
			 
					$copied = copy($_FILES['smt15']['tmp_name'], $smt15);
					
				}
			 
			}
			$surat_kelulusan=$_FILES['surat_kelulusan']['name'];
			if ($surat_kelulusan) 
			{
				$filename = stripslashes($_FILES['surat_kelulusan']['name']);
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
					$size=filesize($_FILES['surat_kelulusan']['tmp_name']);
			 
					if ($size > MAX_SIZE*20024)
					{
						echo '<h4>You have exceeded the size limit!</h4>';
						$errors=1;
					}
			 
					$image_name7=$_POST['nis'].'.'.$extension;
					$surat_kelulusan="../../pi/jalur_pendaftaran/mandiri/surat_kelulusan/".$image_name7;
			 
					$copied = copy($_FILES['surat_kelulusan']['tmp_name'], $surat_kelulusan);
					
				}
			 
			}
			mysql_query("UPDATE t_calon_mahasiswa SET i_thn_akademik = '$i_thn_akademik', c_gel = '$c_gel', n_lengkap = '$n_lengkap', n_jns_kelamin = '$n_jns_kelamin', n_temp_lahir = '$n_temp_lahir', d_lahir = '$d_lahir', n_alamat = '$n_alamat', n_kabupaten = '$n_kabupaten', n_propinsi = '$n_propinsi', c_pos = '$c_pos', i_telp = '$i_telp', i_hp = '$i_hp', n_email = '$n_email', n_ortu = '$n_ortu', n_ibu = '$n_ibu', n_jabatan = '$n_jabatan', nis = '$nis', n_sma = '$n_sma', i_jur_sma = '$i_jur_sma', n_alamat_sma = '$n_alamat_sma', n_kab_sma = '$n_kab_sma', n_prop_sma = '$n_prop_sma', n_pil1 = '$n_pil1', n_pil2 = '$n_pil2', n_pil3 = '$n_pil3', i_temp_ujian = '$i_temp_ujian', c_inf = '$c_inf', c_jalur = '$c_jalur', n_agama = '$i_agama', photo = '$image_name', smt1 = '$image_name2', smt2 = '$image_name3', smt3 = '$image_name4', smt4 = '$image_name5', smt5 = '$image_name6', surat = '$image_name7', nama_guru_bk = '$nama_guru_bk', no_guru_bk = '$no_guru_bk' WHERE i_registrasi = '$i_registrasi'");
			$sqlCek = mysql_query("select t_calon_mahasiswa.*,t_gel.namagel as nama_gel,t_tempat_ujian.namatmp as temp_ujian from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel inner join t_tempat_ujian on t_calon_mahasiswa.i_temp_ujian=t_tempat_ujian.kodetmp where t_calon_mahasiswa.i_registrasi='$i_registrasi'");
    		if(mysql_num_rows($sqlCek)==0) { 
    			header('Location: ../../media.php?module=registrasi');
    			die;
    		} else {
    			header('Location: ../../media.php?module=registrasi');
    		}
		}

	} else {
		header('media.php?module=registrasi');
		die;
	}
}
?>