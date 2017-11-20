<?php
// $session_start();
error_reporting(0);
include "config/koneksi.php";
$briva = mysql_escape_string($_POST["briva"]);
$password =mysql_escape_string($_POST["password"]);

$login=mysql_query("SELECT * FROM t_daftar WHERE nis='$briva' AND password='$password' AND status='bayar'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
session_start();

  // $_SESSION();
  // session_register('kode_briva');
  // session_register(password);
  // session_register(jalur_pendaftaran);
  // session_register(pilihan);
  // session_register(nis);
  // session_register(no_tlp);
  // session_register(email);
  // session_register(nama);  
 // session_register("username");
$queryjalur = mysql_query("SELECT * FROM jalur_pendaftaran WHERE id ='$r[jalur_pendaftaran]' AND status = '1'");
$jalurdaftar = mysql_fetch_array($queryjalur);
 $_SESSION['kode_briva']=$r['kode_briva'];
 $_SESSION['jalur_pendaftaran']= $jalurdaftar['nama_jalur'];
 $_SESSION['pilihan']=$r['pilihan']; 
  $_SESSION['password']=$r['password'];
  $_SESSION['nis']=$r['nis'];
   $_SESSION['no_tlp']=$r['no_tlp'];
    $_SESSION['email']=$r['email'];
	 $_SESSION['nama']=$r['nama'];
   $_SESSION['nis']= $r['nis'];
  $sqlTahun = mysql_query("SELECT *
FROM `t_tahun_akademik` where status='on';");
$row_tampil=mysql_fetch_array($sqlTahun);
  $thn = substr($row_tampil[1],2,3);
$pmdk=0;
$reg=1;
$udn=2;
$stimlog=2;
$poltekpos=1;

  if (preg_match("/$poltekpos/",($r['pilihan']))) {
  $_SESSION['pilihan']	= "POLTEKPOS";
  } elseif (preg_match("/$stimlog/",($r['pilihan']))) {
 $_SESSION['pilihan']	= "STIMLOG";
  }
  
  if (preg_match("/$pmdk/",($r['jalur_pendaftaran']))) {
  $_SESSION['jalur_pendaftaran']	= "PMDK";
  } elseif (preg_match("/$reg/",($r['jalur_pendaftaran']))) {
 $_SESSION['jalur_pendaftaran']	= "Reguler";
  }
elseif (preg_match("/$udn/",($r['jalur_pendaftaran']))) {
 $_SESSION['jalur_pendaftaran']	= "Undangan";
  }
?>
<script type="text/javascript">
  window.location.replace("peserta/media.php?module=registrasi");
</script>
<?php
}
else{
?>
<div class="row">
<div class="col-12 col-lg-3"></div>
<div class="col-12 col-lg-6">  
<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Login gagal!</h4>
  <p>username & password tidak benar atau Anda belum melakukan pembayaran.</p>
  <hr>
  <p class="mb-0"><a href=login><b>ULANGI LAGI</b></a></p>
</div>
</div>
<div class="col-12 col-lg-3"> 
<?php
}
?>
