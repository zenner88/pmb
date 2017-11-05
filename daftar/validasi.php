<?php
session_start();
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

//password
function getPassword($length = 8) {
    $validCharacters = "1234567890QWERTYUIOPLKJHGFDSAZXCVBNM";
    $validCharNumber = strlen($validCharacters);
    $result = "";
    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
    return $result;
}

include "../config/koneksi.php";

$waktu_bayar = date("Y-m-d H:i:s");
$bayar = "belum";
$ypbpi = "77976";
$pmb = "08";
$kode_pendaftaran = getNoPendaftaran();
$nama = $_POST['nama'];
$nis = $_POST['nis'];
$email = $_POST['email'];
$no_tlp = $_POST['no_tlp'];
$pilihan = 2;
$jalur_pendaftaran = $_POST['jalur_pendaftaran'];
$password = getPassword();
$kode_briva = $ypbpi .$pilihan .$pmb .$kode_pendaftaran;

$n_pil1 = $_POST['n_pil1'];
$n_pil2 = $_POST['n_pil2'];
$n_jns_kelamin = $_POST['n_jns_kelamin'];
$n_tempat_lahir = $_POST['n_tempat_lahir'];
$d_lahir = $_POST['d_lahir'];
$n_agama = $_POST['n_agama'];
$n_alamat = $_POST['n_alamat'];
$n_kabupaten = $_POST['n_kabupaten'];
$n_propinsi = $_POST['n_propinsi'];
$c_pos = $_POST['c_pos'];
$ktp = $_POST['ktp'];
$bbm = $_POST['bbm'];
$n_ortu = $_POST['n_ortu'];
$n_ibu = $_POST['n_ibu'];
$n_jabatan = $_POST['n_jabatan'];
$n_sma = $_POST['n_sma'];
$i_jur_sma = $_POST['i_jur_sma'];
$n_alamat_sma = $_POST['n_alamat_sma'];
$n_kab_sma = $_POST['n_kab_sma'];
$n_prop_sma = $_POST['n_prop_sma'];

$nami = $nama;
$niss = $nis;
$nopen = $kode_briva;
$paswod = $password;
$jalu = $jalur_pendaftaran;

$_SESSION['nami']=$nami;
$_SESSION['nis']=$niss;
$_SESSION['nopen']=$nopen;
$_SESSION['paswod']=$paswod;
$_SESSION['jalu']=$jalu;
$_SESSION['pil1']=$n_pil1;
$_SESSION['pil2']=$n_pil2;


//simpan data ke database
$query = mysql_query("insert into t_daftar (id_daftar, nama, nis, email, no_tlp, pilihan, jalur_pendaftaran, password, ypbpi, kode_briva, status, tgl_daftar, bukti_pembayaran, tgl_upload, username, jenis) values('', '$nama','$nis', '$email', '$no_tlp', '$pilihan', '$jalur_pendaftaran', '$password', '$ypbpi','$kode_briva','$bayar','$waktu_bayar','','','','')") or die(mysql_error());

$query = mysql_query("INSERT INTO t_calon_mahasiswa(i_registrasi, i_thn_akademik, c_gel, n_lengkap, n_jns_kelamin, n_temp_lahir, d_lahir, n_alamat, n_kabupaten, n_propinsi, n_kota_lain, c_pos, i_telp, i_hp, n_email, n_ortu, n_ibu, n_instansi, n_jabatan, nis, n_sma, i_jur_sma, n_alamat_sma, n_kab_sma, n_prop_sma, n_pil1, n_pil2, n_pil3, i_temp_ujian, c_inf, q_sdp2, e_prestasi, rata2_XI_2, mtk_XI_2, ing_XI_2, rata2_XII_1, mtk_XII_1, ing_XII_1, nilai_rataujian, nilai_ingujian, nilai_mtkujian, c_jalur, status, diterima, n_ruangan, status_update, waktu_update, history, metode, n_agama, ktp, bbm, photo, rekomendasi, smt11, smt12) VALUES ('$kode_briva','2017','I','$nama','$n_jns_kelamin','$n_tempat_lahir','$d_lahir','$n_alamat','$n_kabupaten','$n_propinsi','-','$c_pos','$no_tlp','$no_tlp','$email','$n_ortu','$n_ibu','-','$n_jabatan','$nis','$n_sma','$i_jur_sma','$n_alamat_sma','$n_kab_sma','$n_prop_sma','$n_pil1','$n_pil2','-','-','-','-','-','-','-','-','-','-','-','-','-','-','$jalur_pendaftaran','Registrasi','-','-','-','-','-','Online','$n_agama','$ktp','$bbm','-','-','-','-')") or die(mysql_error());

if ($query) {
    ?>
<script type="text/javascript">
  window.location.replace("../kartu");
</script>
<?php
}else{
    echo"Ada yang salah coy...";
}
?>

