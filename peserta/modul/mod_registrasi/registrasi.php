<?php
error_reporting(0);
// session_start();
include "../config/koneksi.php";
include "config/recaptchalib.php";
$publickey = "6Le8Tr4SAAAAAOwlk7qk8eZJ7i2gzWRXfK7r420n";
$privatekey = "6Le8Tr4SAAAAAEpek74I8a--2ZC5j09NPQfCk1Ux";
 if (empty($_SESSION['kode_briva']) AND empty($_SESSION['password'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
  $aksi="modul/mod_registrasi/aksi_registrasi.php";
  switch(isset($_GET['act'])) { 
    default:
    $cekdata = mysql_query("SELECT * FROM t_calon_mahasiswa INNER JOIN t_gel ON t_calon_mahasiswa.c_gel = t_gel.KodeGel INNER JOIN jalur_pendaftaran ON t_calon_mahasiswa.c_jalur = jalur_pendaftaran.id WHERE t_calon_mahasiswa.i_registrasi = '$_SESSION[kode_briva]'");
    $rdata = mysql_fetch_array($cekdata);
?>
<?php 
    $sqlCek = mysql_query("select t_calon_mahasiswa.*,t_gel.namagel as nama_gel,t_tempat_ujian.namatmp as temp_ujian from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel inner join t_tempat_ujian on t_calon_mahasiswa.i_temp_ujian=t_tempat_ujian.kodetmp where t_calon_mahasiswa.i_registrasi='$_SESSION[kode_briva]'");
    if(mysql_num_rows($sqlCek)==0) { 
?>
<div class="col-md-12">
  <div class="content-home">
    <?php include 'reguler.php'; ?>
    <?php
        } else {
    ?>
    <div style="text-align: center;">
      <p>Anda Telah Melakukan Registrasi. Registrasi hanya dapat dilakukan satu kali. Terimakasih !!!.</p>
      <a href="bukti_registrasi.php" target="top_blank" class="btn btn-primary">
        Cetak Bukti Registrasi
      </a>
    </div>
    <?php
        } 
    ?>    
  </div>


</div>
<?php
  }
}
?>