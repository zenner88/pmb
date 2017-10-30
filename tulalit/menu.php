<?php
include "../config/koneksi.php";

if ($_SESSION['leveluser']=='admin'){
  $sql=mysql_query("select * from modul where aktif='Y' order by urutan");
  
if ($m=mysql_fetch_array($sql)){
	echo "<li><a href='?module=chatbox'><b>Lihat Chatbox</b></a></li>";
	echo "<li><a href='?module=hubungi'><b>Lihat Pesan Masuk</b></a></li>";
	echo "<li><a href='?module=kategori'><b>Lihat Kategori Jurusan</b></a></li>";
	echo "<li><a href='?module=berita'><b>Lihat Berita</b></a></li>";
	echo "<li><a href='?module=download'><b>Lihat Download</b></a></li>";
	echo "<li><a href='?module=tag'><b>Lihat Tag (Label)</b></a></li>";
	echo "<li><a href='?module=album'><b>Lihat Album</b></a></li>";
	echo "<li><a href='?module=galerifoto'><b>Lihat Galeri Foto</b></a></li>";
	echo "<li><a href='?module=laporan'><b>Lihat Laporan Transaksi</b></a></li>";   
	}
}elseif ($_SESSION['leveluser']=='petugas'){
       echo "<li><a href='?module=daftar'><b>Data Pendaftar</b></a></li>";
       echo "<li><a href='?module=biodata'><b>Belum Isi Biodata</b></a></li>";	
       echo "<li><a href='?module=mhsreguler'><b>Calon MHS Reguler</b></a></li>";
       echo "<li><a href='?module=mhspmdk'><b>Calon MHS PMDK</b></a></li>";
	echo "<li><a href='?module=mhsundangan'><b>Calon MHS UNDANGAN</b></a></li>";
	echo "<li><a href='?module=herregistrasi'><b>Her Registrasi MABA</b></a></li>";

}
else{

}
?>
