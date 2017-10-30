<?php
session_start();
 if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../excel_reader2.php";

$module=$_GET[module];
$act=$_GET[act];

// input excel mhs
if ($module=='mhspmdk' AND $act=='inputmhsexcel'){
if(isset($_POST["submit"]))
	{
		$file = $_FILES['file']['tmp_name'];
		$handle = fopen($file, "r");
		$c = 0;
		while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
		{
			$i_registrasi= $filesop[0];
			$n_nama= $filesop[1];
			$kd_prodi= $filesop[2];
			
			$sql = mysql_query("INSERT INTO t_kelulusan(i_registrasi,n_nama,kd_prodi)VALUES ('$i_registrasi', '$n_nama', '$kd_prodi')");
			$c = $c + 1;
		}
		
			if($sql){
				echo "You database has imported successfully. You have inserted ". $c ." recoreds";
header('location:../../media.php?module='.$module);
			}else{
				echo "Sorry! There is some problem.";
header('location:../../media.php?module='.$module);
			}

	}



 
   }

// Edit Calon Mahasiswa PMDK
elseif ($module=='mhspmdk' AND $act=='editreg'){
	 
	 mysql_query("UPDATE t_calon_mahasiswa SET n_pil1 = '$_POST[pil1]',
                                   n_pil2 = '$_POST[pil2]', 
                                   n_pil3 = '$_POST[pil3]',
								   n_ortu = '$_POST[n_ortu]',
								   n_instansi = '$_POST[n_instansi]',
								   n_jabatan = '$_POST[n_jabatan]',
								   n_lengkap = '$_POST[n_lengkap]',
								   n_jns_kelamin = '$_POST[n_jns_kelamin]',
								   n_temp_lahir = '$_POST[n_temp_lahir]',
								   d_lahir = '$_POST[d_lahir]',
								   n_alamat = '$_POST[n_alamat]',
								   n_propinsi = '$_POST[prop]',
								   n_kabupaten = '$_POST[kab]',
								   n_kota_lain = '$_POST[n_kota_lain]',
								   c_pos = '$_POST[c_pos]',
								   i_telp = '$_POST[i_telp]',
								   i_hp = '$_POST[i_hp]',
								   n_email = '$_POST[n_email]',
								   n_sma = '$_POST[n_sma]',
								   i_jur_sma = '$_POST[i_jur_sma]',
								   n_alamat_sma = '$_POST[n_alamat_sma]',
								   n_prop_sma = '$_POST[n_prop_sma]',
								   n_kab_sma = '$_POST[n_kab_sma]',
								   rata2_XI_2 = '$_POST[rataXI]',
								   mtk_XI_2 = '$_POST[mtkXI]',
								   ing_XI_2 = '$_POST[ingXI]',
								   rata2_XII_1 = '$_POST[rataXII]',
								   mtk_XII_1 = '$_POST[mtkXII]',
								   ing_XII_1 = '$_POST[ingXII]'
                             WHERE i_registrasi   = '$_POST[id]'");
     
  header('location:../../media.php?module='.$module);
}

// Edit Calon Mahasiswa PMDK
elseif ($module=='mhspmdk' AND $act=='pindah'){

//no pendaftaran
function getNoPendaftaran($length = 7) {
    $validCharacters = "1234567890";
    $validCharNumber = strlen($validCharacters);
    $result = "";
    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
    return $result;
}



$ypbpi = "77976";
$pmb = "08";
$kode_pendaftaran = getNoPendaftaran();

$pilihan = $_POST['pilihan'];

$kode_briva = $ypbpi .$pilihan .$pmb .$kode_pendaftaran;
	 
	 mysql_query("UPDATE t_daftar SET kode_briva='$kode_briva',
					pilihan = '$pilihan'
                             WHERE kode_briva   = '$_POST[id]'");

mysql_query("UPDATE t_calon_mahasiswa SET i_registrasi='$kode_briva',
					n_pil1 = '$_POST[pil1]',
                                   n_pil2 = '$_POST[pil2]', 
                                   n_pil3 = '$_POST[pil3]'
                             WHERE i_registrasi   = '$_POST[id]'");

     
  header('location:../../media.php?module='.$module);
}   
	
}
?>