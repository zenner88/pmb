<?php
include "../config/koneksi.php";

if ($_SESSION['leveluser']=='admin'){
  $sql=mysql_query("select * from modul where aktif='Y' order by urutan");
}

if ($m=mysql_fetch_array($sql)){
echo "<li><a href='?module=pin'><b>Cetak PIN</b></a></li>";
echo "<li><a href='?module=tahun'><b>Tahun Pendaftaran</b></a></li>";
echo "<li><a href='?module=gelombang'><b>Kelola Gelombang</b></a></li>";
echo "<li><a href='?module=daftar'><b>Data Calon Pendaftar</b></a></li>";
echo "<li><a href='?module=biodata'><b>Belum Isi Biodata</b></a></li>";	
echo "<li><a href='?module=mhspmdk'><b>Pendaftar Jalur PMDK</b></a></li>";
echo "<li><a href='?module=mhsreguler'><b>Pendaftar Jalur Reguler</b></a></li>";
echo "<li><a href='?module=mhsundangan'><b>Pendaftar Undangan</b></a></li>";
echo "<li><a href='?module=herregistrasi'><b>Her-Registrasi MABA</b></a></li>";
echo "<li><a href='?module=menuutama'><b>Edit Menu Utama</b></a></li>";
echo "<li><a href='?module=submenu'><b>Edit Sub Menu</b></a></li>";
echo "<li><a href='?module=profil'><b>Edit Profil</b></a></li>"; 
echo "<li><a href='?module=welcome'><b>Edit Selamat Datang</b></a></li>";
echo "<li><a href='?module=pmdk'><b>Edit Cara Daftar PMDK</b></a></li>"; 
echo "<li><a href='?module=reguler'><b>Edit Cara Daftar Reguler</b></a></li>"; 
echo "<li><a href='?module=carabeli'><b>Edit Cara Pendaftaran</b></a></li>";
echo "<li><a href='?module=biaya'><b>Edit Biaya</b></a></li>";
echo "<li><a href='?module=header'><b>Ganti Header</b></a></li>";
echo "<li><a href='?module=ym'><b>Edit Panitia PMB Online</b></a></li>";
echo "<li><a href='?module=bank'><b>Edit Metode Pendaftaran</b></a></li>";
echo "<li><a href='?module=banner'><b>Edit Link Terkait</b></a></li>";
  
}
?>
