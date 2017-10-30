<?php
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

include "config/koneksi.php";

$waktu_bayar = date("Y-m-d H:i:s");
$bayar = "belum";
$ypbpi = "77976";
$pmb = "08";
$kode_pendaftaran = getNoPendaftaran();
$nama = $_POST['nama'];
$nis = $_POST['nis'];
$email = $_POST['email'];
$no_tlp = $_POST['no_tlp'];
$pilihan = $_POST['pilihan'];
$jalur_pendaftaran = $_POST['jalur_pendaftaran'];
$password = getPassword();
$kode_briva = $ypbpi .$pilihan .$pmb .$kode_pendaftaran;

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


//simpan data ke database
$query = mysql_query("insert into t_daftar (id_daftar, nama, nis, email, no_tlp, pilihan, jalur_pendaftaran, password, ypbpi, kode_briva, status, tgl_daftar, bukti_pembayaran, tgl_upload, username, jenis) values('', '$nama','$nis', '$email', '$no_tlp', '$pilihan', '$jalur_pendaftaran', '$password', '$ypbpi','$kode_briva','$bayar','$waktu_bayar','','','','')") or die(mysql_error());
 
if ($query) {
    ?>
<script type="text/javascript">
  window.location.replace("kartu");
</script>
<?php
}
?>

